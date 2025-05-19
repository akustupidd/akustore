<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RecoveryCodeMail;
use App\Models\Customer;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class CustomerPasswordResetController extends Controller
{
    // Step 1: Show Forgot Password Form
    public function showForgotPasswordForm()
    {
        return view('web-page.auth.forgot_password');
    }

    // Step 2: Generate OTP and Send Email
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:customers,email']);

        // Generate OTP
        $otp = rand(100000, 999999);

        // Save OTP in database
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(3), // 3-minute expiration
        ]);

        // Send OTP via email using the Mailable
        Mail::to($request->email)->send(new RecoveryCodeMail($otp));

        return redirect()->route('customer.reset-password')->with('email', $request->email);
    }

    // Step 3: Show Reset Password Form
    public function showResetPasswordForm(Request $request)
    {
        $email = session('email'); // Retrieve email from the session
        return view('web-page.auth.reset_password', compact('email'));
    }


    // Step 4: Reset Password
    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'otp' => 'required|numeric',
    //         'password' => 'required|confirmed|min:6',
    //     ]);

    //     // Validate OTP
    //     $otpRecord = Otp::where('email', $request->email)
    //         ->where('otp', $request->otp)
    //         ->where('expires_at', '>=', Carbon::now()) // Check for expiration
    //         ->first();

    //     if (!$otpRecord) {
    //         return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    //     }

    //     // Update password
    //     $customer = Customer::where('email', $request->email)->first();
    //     if (!$customer) {
    //         return back()->withErrors(['email' => 'Customer not found.']);
    //     }

    //     $customer->password = Hash::make($request->password);
    //     $customer->save();

    //     // Delete OTP after use
    //     $otpRecord->delete();

    //     return redirect()->route('customer.login')->with('success', 'Password reset successfully. Please log in.');
    // }
    // public function resendOtp(Request $request)
    // {
    //     $request->validate(['email' => 'required|email|exists:customers,email']);

    //     // Generate new OTP
    //     $otp = rand(100000, 999999);

    //     // Update or create OTP in the database
    //     Otp::updateOrCreate(
    //         ['email' => $request->email],
    //         [
    //             'otp' => $otp,
    //             'expires_at' => Carbon::now()->addMinutes(3), // 3-minute expiration
    //         ]
    //     );

    //     // Send the new OTP via email
    //     Mail::to($request->email)->send(new RecoveryCodeMail($otp));

    //     return back()->with('success', 'A new OTP has been sent to your email address.');
    // }
    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:customers,email']);
    
        // Generate new OTP
        $otp = rand(100000, 999999);
    
        // Update or create OTP in the database and increment the request count
        Otp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(3), // 3-minute expiration
            ]
        );
    
        // Send the new OTP via email
        Mail::to($request->email)->send(new RecoveryCodeMail($otp));
    
        // Redirect back with the email value in the session
        return redirect()->route('customer.reset-password')->with('success', 'A new OTP has been sent to your email address.')->with('email', $request->email);
    }
    

public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'otp' => 'required|numeric',
        'password' => 'required|confirmed|min:6',
    ]);

    // Validate OTP
    $otpRecord = Otp::where('email', $request->email)
        ->where('otp', $request->otp)
        ->first();

    if (!$otpRecord) {
        return back()->withErrors(['otp' => 'Invalid OTP.']);
    }

    // Check if the OTP has expired
    if ($otpRecord->expires_at < Carbon::now()) {
        return back()->withErrors(['otp' => 'Your OTP has expired. Please request a new one.']);
    }

    // Update password
    $customer = Customer::where('email', $request->email)->first();
    if (!$customer) {
        return back()->withErrors(['email' => 'Customer not found.']);
    }

    $customer->password = Hash::make($request->password);
    $customer->save();

    // Delete OTP after use
    $otpRecord->delete();

    return redirect()->route('customer.login')->with('success', 'Password reset successfully. Please log in.');
}



}
