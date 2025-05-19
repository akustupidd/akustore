<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // Correct import
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google Callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the email exists in the database
            $customer = Customer::where('email', $googleUser->getEmail())->first();

            if (!$customer) {
                // If no customer is found, redirect to the login page with an appropriate message
                return redirect()->route('customer.login')->withErrors([
                    'login_error' => 'We didn\'t find your email in our system. Please create an account first.'
                ]);
            }

            // Update or create the customer record
            $customer->update([
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'is_active' => true, // Ensure the account remains active
            ]);

            // Check if the customer is active before logging in
            if (!$customer->is_active) {
                return redirect()->route('customer.login')->withErrors([
                    'login_error' => 'Your account is inactive. Please contact support.'
                ]);
            }

            // Log the customer in
            Auth::guard('customer')->login($customer);

            return redirect()->route('home-page')->with('success', 'Logged in successfully!'); // Redirect to homepage
        } catch (\Exception $e) {
            \Log::error('Google login error', ['error' => $e->getMessage()]);
            return redirect()->route('customer.login')->withErrors([
                'login_error' => 'Unable to log in with Google. Please try again.'
            ]);
        }
    }
}
