<?php

namespace App\Http\Controllers\WebControllers;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Blog;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function Checkout()
    {
        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $carts = Cart::where('user_id', Auth::guard('customer')->user()->id)->get();

        return view('web-page.checkout.index', ['carts' => $carts, 'posts' => $posts]);
    }

    public function PlaceOrder(Request $request)
    {
        $request->validate([
            'contact' => 'required',
            'country' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'shipping' => 'required',
            'payment' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // Calculate shipping cost
            $shippingCost = $this->calculateShippingCost($request->input('shipping'));
            Log::info('Shipping method:', ['method' => $request->input('shipping')]);
            Log::info('Shipping cost:', ['cost' => $shippingCost]);

            $userId = Auth::guard('customer')->user()->id;
            $cartitems = Cart::where('user_id', $userId)->get();

            if ($cartitems->isEmpty()) {
                throw new \Exception('Cart is empty.');
            }

            // Calculate total order amount
            $orderTotal = $cartitems->sum(function ($item) {
                Log::info("Cart item - Product ID: {$item->product_id}, Price: {$item->price}, Quantity: {$item->quantity}");
                return $item->price * $item->quantity;
            }) + $shippingCost;

            Log::info('Order total:', ['total' => $orderTotal]);

            // Create the order
            $order = Orders::create([
                'contact' => $request->input('contact'),
                'country' => $request->input('country'),
                'fname' => $request->input('fname'),
                'lname' => $request->input('lname'),
                'address' => $request->input('address'),
                'apartment' => $request->input('apartment'),
                'city' => $request->input('city'),
                'postal_code' => $request->input('postal_code'),
                'shipping' => $shippingCost,
                'payment' => $request->input('payment'),
                'status' => 'pending',
                'tracking_no' => 'Lawliet Store' . rand(1111, 9999),
                'total' => $orderTotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($cartitems as $cartitem) {
                $product = Product::find($cartitem->product_id);
                $stock = $product ? $product->stock : null;

                if (!$stock || $stock->quantity < $cartitem->quantity) {
                    throw new \Exception('Insufficient stock for product: ' . $cartitem->name);
                }

                // Create order items
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $cartitem->product_id,
                    'product_type' => $cartitem->product_type,
                    'user_id' => $userId,
                    'product_name' => $cartitem->name,
                    'quantity' => $cartitem->quantity,
                    'price' => $cartitem->price,
                    'ram' => $cartitem->ram,
                    'storage' => $cartitem->storage,
                    'color' => $cartitem->color,
                ]);

                // Reduce stock quantity
                $stock->quantity -= $cartitem->quantity;
                $stock->save();
            }

            // Clear the cart
            Cart::where('user_id', $userId)->delete();

            DB::commit();
            return redirect()->route('home-page')->with('message', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order placement failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    private function calculateShippingCost($shippingMethod)
    {
        // Add logic for dynamic shipping cost calculation
        switch ($shippingMethod) {
            case 'express':
                return 20.00;
            case 'standard':
                return 10.00;
            default:
                return 15.00;
        }
    }
}
