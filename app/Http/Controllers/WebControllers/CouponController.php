<?php

namespace App\Http\Controllers\WebControllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Blog;
class CouponController extends Controller
{
    public function Coupon() {
        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();
        return view('web-page.coupon.index', ['posts'=> $posts]);
    }
}
