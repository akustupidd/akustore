<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class clientController extends Controller
{
    // Display Customer List with Search and Pagination
    public function Customer(Request $request)
    {
        $rowLength = $request->query('row_length', 10);
        $searchValue = $request->query('searchValue', ''); 

        // Query customers with pagination and optional search
        $customers = Customer::query()
            ->when($searchValue, function ($query, $searchValue) {
                $query->where('customers.name', 'LIKE', "%$searchValue%")
                    ->orWhere('customers.email', 'LIKE', "%$searchValue%")
                    ->orWhere('customers.phone_number', 'LIKE', "%$searchValue%");
            })
            ->paginate($rowLength);

        // Process customers to calculate location
        foreach ($customers as $customer) {
            $latitude = $customer->latitude;
            $longitude = $customer->longitude;

            Log::info("Customer ID: {$customer->id}, Latitude: {$latitude}, Longitude: {$longitude}");

            if (!empty($latitude) && !empty($longitude)) {
                try {
                    $apiKey = '6e73d01739b343748b08fe7433780b71'; // OpenCage API key
                    $response = Http::get("https://api.opencagedata.com/geocode/v1/json", [
                        'q' => "{$latitude},{$longitude}",
                        'key' => $apiKey,
                    ]);

                    if ($response->successful() && isset($response->json()['results'][0]['formatted'])) {
                        $customer->location = $response->json()['results'][0]['formatted'];
                    } else {
                        $customer->location = 'Address not found';
                    }
                } catch (\Exception $e) {
                    Log::error("Error fetching address for customer ID {$customer->id}: " . $e->getMessage());
                    $customer->location = 'API request failed';
                }
            } else {
                $customer->location = 'Invalid or missing location data';
            }
        }

        return view('page.client.index', [
            'customers' => $customers,
            'search_value' => $searchValue,
            'paginate' => $rowLength
        ]);
    }

    // Insert Customer Form
    public function Insert()
    {
        return view('page.client.insert');
    }

    // Handle Insert Customer Data
    public function InsertData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:customers|max:255',
            'email' => 'required|email|unique:customers',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $customer = new Customer();
        $customer->fill($request->except(['password', 'image']));
        $customer->password = Hash::make($request->input('password'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            $customer->image = $filename;
        }

        $customer->save();

        return redirect()->route('client')->with('message', 'Customer Inserted Successfully');
    }

    // Update Customer Form
    public function Update($id)
    {
        $customer = Customer::findOrFail($id);
        return view('page.client.edit', ['customer' => $customer]);
    }

    // Handle Update Customer Data
    public function DataUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:customers,username,' . $id,
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone_number' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->fill($request->except(['image']));

        if ($request->hasFile('image')) {
            $oldImagePath = public_path('uploads/users/' . $customer->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            $customer->image = $filename;
        }

        $customer->save();

        return redirect()->route('client')->with('message', 'Customer Updated Successfully');
    }

    // Handle Delete Customer
    public function Delete($id)
    {
        $customer = Customer::findOrFail($id);

        if (!empty($customer->image)) {
            $imagePath = public_path('uploads/users/' . $customer->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
        }
        $customer->delete();

        return redirect()->route('client')->with('message', 'Customer Deleted Successfully');
    }
}
