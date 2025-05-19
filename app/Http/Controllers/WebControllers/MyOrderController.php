<?php

namespace App\Http\Controllers\WebControllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\OrderItems;
use App\Models\Blog;

class MyOrderController extends Controller
{
    public function MyOrder() {

        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();
        
        $order_items = OrderItems::where('user_id', Auth::guard('customer')->user()->id)->get();
        return view('web-page.my-order.index', ['order_items' =>  $order_items, 'posts' => $posts]);
    }
}
