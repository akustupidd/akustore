<?php

namespace App\Http\Controllers\WebControllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Signin() {
        return view('web-page.auth.login');
    }

    public function Signup() {
        return view('web-page.auth.register');
    }
}
