<?php

namespace App\View\Components;

use App\Models\AccessaryType;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Accessaries;
use App\Models\ProductType;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Blog;
use Request;
class WebHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $products_type = ProductType::all();
        $brands = Brand::all();
        $carts = [];
        if (Auth::guard('customer')->check()) {
            $carts = Cart::where('user_id', Auth::guard('customer')->user()->id)->get();
        }
        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();
        $accessaries_type = AccessaryType::all();

        return view('components.web-header', [
            'products_type'=>$products_type,
            'brands' => $brands,
            'carts' => $carts,
            'posts' => $posts,
            'accessaries_type' => $accessaries_type
        ]);
    }
}
