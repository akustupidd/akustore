<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('web-page.auth.login');
    }

    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt authentication
        if (Auth::guard('customer')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $customer = Auth::guard('customer')->user();

            // Capture login details
            $device = $request->header('User-Agent');
            $ip = $request->ip();
            $browser = $this->getBrowser($device);
            $location = $this->getLocation($ip);
            $loginTime = now();

            // Update customer last active and set as active
            DB::table('customers')->where('id', $customer->id)->update([
                'last_active' => $loginTime,
                'last_device' => $device,
                'last_browser' => $browser,
                'last_ip' => $ip,
                'last_location' => $location,
                'is_active' => true, // Mark as active
            ]);

            return redirect()->intended(route('profile'))->with('success', 'Login successful!');
        }

        // On failure, redirect back with errors
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        $customer = Auth::guard('customer')->user();
        if ($customer) {
            // Mark the customer as inactive
            DB::table('customers')->where('id', $customer->id)->update(['is_active' => false]);
        }

        Auth::guard('customer')->logout();
        return redirect()->route('home-page')->with('success', 'You have been logged out.');
    }

    private function getBrowser($userAgent)
    {
        if (strpos($userAgent, 'Firefox') !== false) return 'Firefox';
        if (strpos($userAgent, 'Chrome') !== false) return 'Chrome';
        if (strpos($userAgent, 'Safari') !== false && strpos($userAgent, 'Chrome') === false) return 'Safari';
        if (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident') !== false) return 'Internet Explorer';
        return 'Unknown';
    }

    private function getLocation($ip)
    {
        // Use a third-party service to get the location
        try {
            $response = file_get_contents("http://ip-api.com/json/$ip");
            $data = json_decode($response, true);
            return isset($data['city'], $data['country']) ? $data['city'] . ', ' . $data['country'] : 'Unknown';
        } catch (\Exception $e) {
            return 'Unknown';
        }
    }
    public function saveLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $customer = Auth::guard('customer')->user();

        if ($customer) {
            DB::table('customers')->where('id', $customer->id)->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            return response()->json(['success' => true, 'message' => 'Location updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
    }

}
