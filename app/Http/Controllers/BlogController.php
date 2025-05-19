<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // ✅ Display Blogs with Pagination & Search
    public function index(Request $request) {
        $search_value = $request->query("search", '');
        $rowLength = $request->query('row_length', 10);

        try {
            $blogs = Blog::with(['admin', 'category', 'tags', 'media', 'comments'])
                ->where('title', 'like', '%' . $search_value . '%')
                ->orderBy('published_at', 'desc')
                ->paginate($rowLength);

            return view('page.blogs.index', compact('blogs', 'search_value'));
        } catch (\Exception $e) {
            Log::error('Error fetching blogs: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'An error occurred while fetching blogs.');
        }
    }

    // ✅ Show Insert Page
    public function create() {
        try {
            $categories = BlogCategory::all();
            return view('page.blogs.insert', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            return redirect()->route('blog-ad')->with('error', 'Error loading categories.');
        }
    }

    // ✅ Insert Blog
    public function store(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'status' => 'required|in:draft,published,archived',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg|max:10000',
            'tags' => 'nullable|string',
            'published_at' => 'nullable|date|after_or_equal:today',
        ]);

        if (!Auth::guard('admin')->check()) {
            return redirect()->route('blog-ad')->with('error', 'Unauthorized access.');
        }

        DB::beginTransaction();
        try {
            $blog = new Blog();
            $blog->fill($validated);
            $blog->slug = Str::slug($validated['title']);
            $blog->admin_id = Auth::guard('admin')->id();
            $blog->published_at = ($validated['status'] === 'published') ? now() : null;
            $blog->save();

            // ✅ Handle Image Upload (Move to Public Directory)
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                Log::info('Uploading Image...');
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/blogs'), $filename); // ✅ Move to Public Folder

                $blog->cover_image = 'uploads/blogs/' . $filename; // ✅ Save Correct Path
                $blog->media_type = 'image'; 
                $blog->save();
                Log::info('Image Uploaded Successfully: ' . $filename);
            }

            // ✅ Handle Video Upload (Move to Public Directory)
            if ($request->hasFile('video') && $request->file('video')->isValid()) {
                Log::info('Uploading Video...');
                $file = $request->file('video');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/blogs/videos'), $filename); // ✅ Move to Public Folder

                $blog->video_url = 'uploads/blogs/videos/' . $filename; // ✅ Save Correct Path
                $blog->media_type = 'video';
                $blog->save();
                Log::info('Video Uploaded Successfully: ' . $filename);
            }



            // ✅ Handle Tags
            if ($validated['tags']) {
                $tagNames = array_map('trim', explode(',', $validated['tags']));
                $tagIds = [];
                foreach ($tagNames as $tagName) {
                    if (!empty($tagName)) {
                        $tag = BlogTag::firstOrCreate(['name' => $tagName]);
                        $tagIds[] = $tag->id;
                    }
                }
                $blog->tags()->sync($tagIds);
            }

            DB::commit();
            return redirect()->route('blog-ad')->with('message', 'Blog Inserted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error inserting blog: ' . $e->getMessage());
            return redirect()->route('blog-ad')->with('error', 'Failed to insert blog.');
        }
    }

    // ✅ Delete Blog
    public function destroy($id) {
        try {
            $blog = Blog::findOrFail($id);
            $blog->delete();
            return redirect()->route('blog-ad')->with('message', 'Blog Deleted Successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting blog: ' . $e->getMessage());
            return redirect()->route('blog-ad')->with('error', 'Failed to delete blog.');
        }
    }
    public function toggleStatus($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Toggle the status between "published" and "archived"
            $blog->status = ($blog->status === 'published') ? 'archived' : 'published';
            $blog->save();

            return response()->json(['success' => true, 'status' => $blog->status]);
        } catch (\Exception $e) {
            Log::error('Error toggling blog status: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to update blog status'], 500);
        }
    }
}
