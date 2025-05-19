<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display User List with Search and Pagination
    public function User(Request $request)
    {
        $rowLength = $request->query('row_length', 10);
        $searchValue = $request->query('searchValue', '');  // ensure searchValue is being used here

        $users = Admin::leftJoin('roles', 'admins.role_id', '=', 'roles.id')
            ->select('admins.*', 'roles.name as role_name')
            ->when($searchValue, function ($query, $searchValue) {
                $query->where('admins.username', 'LIKE', "%$searchValue%")
                    ->orWhere('admins.name', 'LIKE', "%$searchValue%")
                    ->orWhere('admins.email', 'LIKE', "%$searchValue%");
            })
            ->paginate($rowLength);

        return view('page.users.index', [
            'users' => $users,
            'search_value' => $searchValue,
            'paginate' => $rowLength
        ]);
    }


    // Insert User Form
    public function Insert()
    {
        $roles = Role::all();
        return view('page.users.insert', ['roles' => $roles]);
    }

    // Handle User Insert Data
    public function InsertData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:admins|max:255',
            'email' => 'required|email|unique:admins',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = new Admin();
        $user->fill($request->except(['password', 'image']));
        $user->password = Hash::make($request->input('password'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            $user->image = $filename;
        }

        $user->save();

        return redirect()->route('user')->with('message', 'User Inserted Successfully');
    }

    // Update User Form
    public function Update($id)
    {
        $user = Admin::findOrFail($id);
        $roles = Role::all();
        return view('page.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    // Handle Update Data
    public function DataUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Admin::findOrFail($id);
        $user->fill($request->except(['image']));

        if ($request->hasFile('image')) {
            $oldImagePath = public_path('uploads/users/' . $user->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            $user->image = $filename;
        }

        $user->save();

        return redirect()->route('user')->with('message', 'User Updated Successfully');
    }

    // Handle Delete User
    public function Delete($id)
    {
        $user = Admin::findOrFail($id);

        // Check if the image path is valid and is a file
        if (!empty($user->image)) {
            $imagePath = public_path('uploads/users/' . $user->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        $user->delete();

        return redirect()->route('user')->with('message', 'User Deleted Successfully');
    }

}
