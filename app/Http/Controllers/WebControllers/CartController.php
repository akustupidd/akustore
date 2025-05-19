<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Blog;

class CartController extends Controller
{
    public function Cart()
    {
        // Fetch latest blog posts
        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();

        // Get the logged-in user's ID
        $userId = Auth::guard('customer')->user()->id;

        // Fetch cart items for the user
        $carts = Cart::where('user_id', $userId)->get();

        foreach ($carts as $cart) {
            // Retrieve product and stock info
            $product = Product::find($cart->product_id);
            $stock = $product->stock;

            // Update cart item details with stock data
            $cart->price = $stock ? $stock->price : $cart->price; // Use stock price
            $cart->stock_quantity = $stock ? $stock->quantity : 0; // Use stock quantity
        }

        // Return view with cart and blog posts data
        return view('web-page.cart.cart', ['carts' => $carts, 'posts' => $posts]);
    }

    public function AddToCart(Request $request, $id)
    {
        // Check if the user is logged in
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login')->with('error', 'You need to be logged in to add items to the cart.');
        }

        // Find the product by ID
        $product = Product::findOrFail($id);
        $userId = Auth::guard('customer')->user()->id;

        // Get the requested quantity, default to 1 if not specified
        $quantity = $request->input('quantity') ?: 1;

        // Check if stock exists
        $stock = $product->stock; // Assuming 'stock' is a relationship in Product model
        if (!$stock) {
            return redirect()->back()->with('error', 'Stock information is unavailable for this product.');
        }

        // Check if enough stock is available
        if ($stock->quantity < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        // Prepare cart item data
        $cartData = [
            'product_id' => $product->id,
            'product_type' => $product->product_type,
            'image' => $product->image,
            'name' => $product->name,
            'quantity' => $quantity,
            'price' => $stock->price, // Use stock price
            'user_id' => $userId,
            'color' => $request->input('color', 'default'), // Handle default color
            'ram' => $request->input('ram', 'default'), // Handle default RAM
            'storage' => $request->input('storage', 'default'), // Handle default storage
        ];

        // Find or create the cart item
        $cartItem = Cart::where('product_id', $product->id)
                        ->where('user_id', $userId)
                        ->first();

        if ($cartItem) {
            // If item already exists, increase quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create a new cart item
            Cart::create($cartData);
        }

        // Redirect back with success message
        return redirect()->back()->with('message', 'Product added to cart successfully!');
    }

    public function updateCart(Request $request, $id)
    {
        // Validate quantity input
        $request->validate([
            'quantity' => 'required|integer|min=1'
        ]);

        // Find the cart item
        $cartItem = Cart::findOrFail($id);
        $product = Product::find($cartItem->product_id);
        $stock = $product->stock;

        // Check if enough stock is available
        if ($stock->quantity < $request->input('quantity')) {
            return response()->json(['success' => false, 'warning' => 'Not enough stock available.']);
        }

        // Update cart item quantity
        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();

        // Return success response
        return response()->json(['success' => true, 'message' => 'Cart updated successfully!']);
    }

    public function RemoveCart($id)
    {
        // Find and delete the cart item
        $cart = Cart::findOrFail($id);
        $cart->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Item has been removed!');
    }
}
