<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\File; // For file operations
use Illuminate\Support\Facades\Log; // Import the Log facade

class BrandController extends Controller
{
    public function brand(Request $request) {
        $search_value = $request->query("search");
        $rowLength = $request->query('row_length', 10);

        // Add search functionality
        $query = Brand::query();
        if ($search_value) {
            $query->where('name', 'LIKE', '%' . $search_value . '%');
        }

        $brands = $query->paginate($rowLength);

        return view('page.brands.index', [
            'brands' => $brands,
            'search_value' => $search_value,
        ]);
    }

    public function InsertData(Request $request) {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name', // Ensure the name is unique in the 'brands' table
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        try {
            $brand = new Brand();
            $brand->name = $request->input('name');
    
            // Handle file upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/brands', $filename);
                $brand->image = $filename;
            }
    
            $brand->save();
    
            return redirect()->route('brand')->with('message', 'Brand Inserted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('brand')->with('error', 'Failed to insert brand. Please try again.');

        }
    }
    
    public function DataUpdate(Request $request, $id) {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $id, // Ensure the name is unique except for the current record
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        try {
            $brand = Brand::findOrFail($id); // Ensure the record exists
            $brand->name = $request->input('name');
    
            // Handle file upload
            if ($request->hasFile('image')) {
                // Delete the existing file if it exists
                $destination = public_path('uploads/brands/' . $brand->image);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
    
                // Save the new file
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/brands', $filename);
                $brand->image = $filename;
            }
    
            $brand->save();
    
            return redirect()->route('brand')->with('message', 'Brand Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->route('brand')->with('error', 'Failed to update brand. Please try again.');
        }
    }
    

    // Delete
    public function Delete($id) {
        try {
            $brand = Brand::findOrFail($id);

            // Delete the file associated with the brand
            $destination = public_path('uploads/brands/' . $brand->image);
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $brand->delete();

            return redirect()->route('brand')->with('message', 'Brand Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('brand')->with('error', 'Failed to delete brand. Please try again.');
        }
        
    }
}
