<?php

namespace App\Http\Controllers\WebControllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Blog;

class ChangePasswordController extends Controller
{
    public function ChangePassword() {
        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();
        return view('web-page.change-password.index', ['posts'=> $posts]);
    }

    public function UpdatePassword(Request $request) {

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:new_password',
        ]);

        // Check if the new password is different from the current password
        if (Hash::check($request->input('new_password'), $request->user()->password)) {
            return redirect()
            ->back()
            ->withErrors(['new_password' => 'New password cannot be the same as the current password'])
            ->withInput();
        }
        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return redirect()
            ->back()
            ->withErrors(['current_password' => 'Current password does not match'])
            ->withInput();
        }
        // Update the user's password
        $user = Auth::user(); // Get the authenticated user
        if ($user) {
            $user->password = bcrypt($request->input('new_password')); // Hash the new password
            $user->save(); // Save the changes
        }
        
    
        return redirect()->back()->with('message', 'Password changed successfully');
    }
}
