<?php

namespace App\Http\Controllers\WebControllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Blog;

class ContactController extends Controller
{
    public function Contact(){
        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();
        return view('web-page.contact.index', ['posts'=> $posts]);
    }
}
