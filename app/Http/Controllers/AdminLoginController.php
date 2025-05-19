<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    // Show the admin login form
    public function showLoginForm()
    {
        return view('page.auth.login'); // Create this view for admin login
    }

    // Handle login request
    public function login(Request $request)
    {
        // // Validate the admin login form
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required|min:6',
        // ]);

        // Attempt to log the admin in
        if (Auth::guard('admin')->attempt([
            'email' => $request->email, 
            'password' => $request->password
        ], $request->remember)) {
            // Redirect to intended admin dashboard
            return redirect()->intended(route('dashboard'));
        }

        // If unsuccessful, redirect back to the login form with the data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        // Optionally invalidate the session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login'); // Redirect to admin login
    }
}
