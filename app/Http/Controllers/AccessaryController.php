<?php

namespace App\Http\Controllers;

use App\Models\AccessaryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade

class AccessaryController extends Controller
{
    public function Accessaries(Request $request)
    {
        $search_value = $request->query("search");
        $rowLength = $request->query('row_length', 10);

        // Add search functionality
        $query = AccessaryType::query();
        if ($search_value) {
            $query->where('name', 'LIKE', '%' . $search_value . '%');
        }

        $accessaries_type = $query->paginate($rowLength);

        return view('page.accessaries.index', [
            'accessaries_type' => $accessaries_type,
            'search_value' => $search_value,
        ]);
    }

    public function InsertData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $accessary_type = new AccessaryType();
        $accessary_type->name = $request->input('name');
        $accessary_type->save();

        return redirect()->route('accessaries')->with('message', 'Accessary Type Inserted Successfully');
    }

    public function DataUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $accessary_type = AccessaryType::findOrFail($id); // Ensure the record exists
            $accessary_type->name = $request->input('name');
            $accessary_type->save();

            return redirect()->route('accessaries')->with('message', 'Accessary Updated Successfully');
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error updating Accessary: ' . $e->getMessage());

            return redirect()->route('accessaries')->with('error', 'Failed to update Accessary. Please try again.');
        }
    }

    public function Delete(Request $request, $id)
    {
        try {
            AccessaryType::destroy($request->id);
            return redirect()->route('accessaries')->with('message', 'Accessaries Type Deleted Successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting Accessary: ' . $e->getMessage());
            return redirect()->route('accessaries')->with('error', 'Failed to delete Accessaries Type');
        }
    }
}
