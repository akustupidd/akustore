<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\ProductType;
use App\Models\Category;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class BlogController extends Controller
{
    // ✅ Display All Blogs (Only Published Blogs)
    public function Blog(Request $request) {
        // Get search query and selected blog category
        $search = $request->get('search', '');
        $selectedCategory = $request->get('blog_category', '');

        // Fetch all blog categories for the dropdown
        $categories = BlogCategory::orderBy('name', 'asc')->get();

        // Query blogs with category filter
        $blogs = Blog::with('blogCategory')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')
                             ->orWhere('content', 'like', '%' . $search . '%');
            })
            ->when($selectedCategory, function ($query, $selectedCategory) {
                return $query->where('blog_category_id', $selectedCategory);
            })
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        // **Fallback Search**: If no results, remove category filter and search again
        $fallbackSearch = false;
        if ($blogs->isEmpty() && !empty($search)) {
            $blogs = Blog::with('blogCategory')
                ->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                          ->orWhere('content', 'like', '%' . $search . '%');
                })
                ->where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->paginate(6);
            $fallbackSearch = true;
        }

        return view('web-page.blog.blog', $this->commonData([
            'blogs' => $blogs,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'search' => $search,
            'fallbackSearch' => $fallbackSearch, 
        ]));
    }

    // ✅ Blog Detail Page
    public function BlogDetail($slug) {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        
        $brands = Brand::all();
        $products_type = ProductType::all();
        $categories = Category::all();
        $posts = Blog::orderBy('published_at', 'desc')->take(3)->get();
        
        // ✅ Fetch related posts
        $relatedPosts = Blog::where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->where('status', 'published')
            ->inRandomOrder()
            ->take(3)
            ->get();
    
        // ✅ Fetch comments with recursive replies
        $comments = BlogComment::where('blog_post_id', $blog->id)
            ->whereNull('parent_id') // ✅ Only fetch parent comments
            ->with('replies') // ✅ Load all replies recursively
            ->latest()
            ->get();
    
        return view('web-page.blog.blog-detail', [
            'blog' => $blog,
            'brands' => $brands,
            'products_type' => $products_type,
            'categories' => $categories,
            'posts' => $posts,
            'relatedPosts' => $relatedPosts,
            'comments' => $comments
        ]);
    }
    

    // ✅ Store a New Comment (or Reply)
    public function storeComment(Request $request, $blogId) {
        // ✅ Ensure User is Logged In
        if (!Auth::guard('customer')->check()) {
            return back()->with('error', 'You must log in to post a comment.');
        }

        // ✅ Validate Input
        $request->validate([
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:blog_comments,id' // Parent comment for replies
        ]);

        // ✅ Store Comment (or Reply)
        BlogComment::create([
            'blog_post_id' => $blogId,
            'customer_id' => Auth::guard('customer')->id(),
            'comment' => $request->comment,
            'parent_id' => $request->parent_id ?? null // Set parent_id if it's a reply
        ]);

        return back()->with('success', 'Your comment has been posted.');
    }

    // ✅ Common Data for Views (Avoid Duplicate Queries)
    private function commonData(array $data = []) {
        return array_merge([
            'brands' => Brand::all(),
            'products_type' => ProductType::all(),
            'categories' => Category::all(),
            'posts' => Blog::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->get()
        ], $data);
    }
}
