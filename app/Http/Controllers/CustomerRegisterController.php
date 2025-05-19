<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeCustomerMail;
use Carbon\Carbon;

class CustomerRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:customer');
    }

    // Show the customer registration form
    public function showRegistrationForm()
    {
        return view('web-page.auth.register');
    }

    // Handle the registration request
    public function register(Request $request)
    {
        // Log input for debugging
        Log::info('Register form input', $request->all());

        // Validate the form data
        $validatedData = $this->validator($request->all());

        // Begin a transaction
        DB::beginTransaction();

        try {
            // Create the customer
            $customer = $this->create($validatedData);

            // Create the customer's address
            $this->createAddress($customer->id, $request);

            // Log the customer in
            auth()->guard('customer')->login($customer);

            // Capture and update login details
            $this->updateLoginDetails($customer, $request);

            // Commit the transaction
            DB::commit();

            // Send the welcome email
            $this->sendWelcomeEmail($customer);

            // Redirect on success
            return redirect()->route('home')->with('success', 'Registration successful! Welcome!');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error
            Log::error('Registration failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withErrors(['error' => 'An error occurred during registration. Please try again later.']);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$/',
                'confirmed'
            ],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'dob' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $age = Carbon::parse($value)->age;
                    if ($age < 16) {
                        $fail('You must be at least 16 years old to register.');
                    }
                },
            ],
            'phone_number' => ['required', 'string', 'max:15'],
            'address_line1' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
        ])->validate();
    }

    protected function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'dob' => $data['dob'],
        ]);
    }

    protected function createAddress($customerId, Request $request)
    {
        CAddress::create([
            'customer_id' => $customerId,
            'address_line1' => $request->input('address_line1'),
            'address_line2' => $request->input('address_line2', null),
            'city' => $request->input('city'),
            'state' => $request->input('state', null),
            'postal_code' => $request->input('postal_code', null),
            'country' => $request->input('country'),
        ]);
    }

    protected function updateLoginDetails(Customer $customer, Request $request)
    {
        $device = $request->header('User-Agent');
        $ip = $request->ip();
        $browser = $this->getBrowser($device);
        $loginTime = now();

        DB::table('customers')->where('id', $customer->id)->update([
            'last_active' => $loginTime,
            'last_device' => $device,
            'last_browser' => $browser,
            'last_ip' => $ip,
            'is_active' => true,
        ]);
    }

    protected function sendWelcomeEmail(Customer $customer)
    {
        try {
            Mail::to($customer->email)->send(new WelcomeCustomerMail($customer));
        } catch (\Exception $e) {
            Log::error('Failed to send welcome email to customer ID ' . $customer->id . ': ' . $e->getMessage());
        }
    }

    private function getBrowser($userAgent)
    {
        if (strpos($userAgent, 'Firefox') !== false) return 'Firefox';
        if (strpos($userAgent, 'Chrome') !== false) return 'Chrome';
        if (strpos($userAgent, 'Safari') !== false && strpos($userAgent, 'Chrome') === false) return 'Safari';
        if (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident') !== false) return 'Internet Explorer';
        return 'Unknown';
    }
}
