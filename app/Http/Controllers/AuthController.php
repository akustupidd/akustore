<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Auth;
class AuthController extends Controller
{
   public function SignIn() {
      return view('auth.login');
   }

   public function SignUp() {
      return view('auth.register');
   }

   public function ForgotPass() {
      return view('auth.forgot-password');
   }

   public function SigninWeb() {
      return view('web-page.auth.login');
   }

   public function signOut(Request $request)
   {
      Auth::logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return  redirect()->route('sign-in');
   }
}
