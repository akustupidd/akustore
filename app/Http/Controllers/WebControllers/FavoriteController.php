<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Blog;

class FavoriteController extends Controller
{
    // Apply middleware to all methods in this controller
    public function __construct()
    {
        $this->middleware('auth:customer'); // Ensures only authenticated 'customer' users can access these routes
    }

    public function Favorite()
    {
        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $favorites = Favorite::where('user_id', Auth::guard('customer')->user()->id)->get();
        return view('web-page.favorite.index', ['favorites' => $favorites, 'posts' => $posts]);
    }

    public function FavoriteAdd($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::guard('customer')->user();

        // Check if the favorite already exists
        $favoriteExists = Favorite::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->exists();

        if ($favoriteExists) {
            return redirect()->back()->with('message', 'Product already in favorites!');
        }

        // Fetch the product price from the stock table
        $stock = \DB::table('stock')->where('product_id', $product->id)->first();

        if (!$stock || !isset($stock->price)) {
            return redirect()->back()->with('error', 'Price information not available for this product.');
        }

        // Add new favorite
        $favorite = new Favorite();
        $favorite->user_id = $user->id;
        $favorite->product_id = $product->id;
        $favorite->name = $product->name;
        $favorite->price = $stock->price; // Use price from the stock table
        $favorite->image = $product->image;
        $favorite->save();

        return redirect()->back()->with('message', 'Product added to favorites successfully!');
    }

    public function RemoveFav($id)
    {
        try {
            // Find and delete the favorite by its ID
            $favorite = Favorite::findOrFail($id);
            $favorite->delete();

            return redirect()->back()->with('message', 'Product removed from favorites successfully!');
        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'An error occurred while removing the product from favorites.');
        }
    }
}
