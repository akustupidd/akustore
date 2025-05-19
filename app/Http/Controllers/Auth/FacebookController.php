<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    // Redirect to Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Handle Facebook Callback
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            // Find or create the customer in your database
            $customer = Customer::updateOrCreate(
                ['email' => $facebookUser->getEmail()],
                [
                    'name' => $facebookUser->getName(),
                    'facebook_id' => $facebookUser->getId(),
                    'avatar' => $facebookUser->getAvatar(),
                    'is_active' => true, // Set account to active by default
                ]
            );

            // Check if the customer is active before logging in
            if (!$customer->is_active) {
                return redirect()->route('customer.login')->withErrors(['login_error' => 'Your account is inactive. Please contact support.']);
            }

            // Log the customer in
            Auth::guard('customer')->login($customer);

            return redirect()->route('home-page')->with('success', 'Logged in successfully!');
        } catch (\Exception $e) {
            \Log::error('Facebook login error', ['error' => $e->getMessage()]);
            return redirect()->route('customer.login')->withErrors(['login_error' => 'Unable to log in with Facebook. Please try again.']);
        }
    }
}
