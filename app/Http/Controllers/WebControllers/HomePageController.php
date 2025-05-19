<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banners;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Feature;
use App\Models\Blog;
use Stevebauman\Location\Facades\Location;

class HomePageController extends Controller
{
    public function HomePage(Request $request) {
        $slide_banners  = Banners::all();
        $products = Product::leftJoin('products_type', 'products_type.id', '=', 'products.product_type') 
        ->select('products.*', 'products_type.name as product_type_name')
        ->where(function($query) use ($request) {
            $query->where('products_type.name', 'like', '%'.$request->query("search").'%')
                  ->orWhereNull('products_type.name');
        })->get();
    
        $features_top  = Feature::where('type', 'Feature Top')->first();
        $features_bottom  = Feature::where('type', 'Feature Bottom')->take(2)->get();
        $features_center  = Feature::where('type', 'Feature Center')->take(2)->get();
        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $categories = Category::all();
        $brands = Brand::all();
    
        // Get the user's country code
        $position = Location::get(request()->ip());
        $countryCode = $position ? $position->countryCode : 'Unknown';
    
        return view('web-page.home', [
            'slide_banners' => $slide_banners,
            'products' => $products,
            'features_center' => $features_center,
            'features_top' => $features_top,
            'features_bottom' => $features_bottom,
            'posts' => $posts,
            'categories' => $categories,
            'brands' => $brands,
            'countryCode' => $countryCode, // Pass countryCode to the view
        ]);
    }
    

    public function quickView($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

    return response()->json($product);
    }

}
