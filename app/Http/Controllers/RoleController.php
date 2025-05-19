<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function Role(Request $request) {
    $search = $request->query('search');
    $rowLength = $request->query('row_length', 10); // default 10 per page

    $query = Role::query();

    if ($search) {
        $query->where('name', 'LIKE', '%' . $search . '%');
    }

    $roles = $query->paginate($rowLength)->withQueryString();

    return view('page.roles.index', [
        'roles' => $roles,
        'search_value' => $search,
    ]);
}


    public function Insert() {
        $permissions = Permissions::orderBy('name', 'ASC')->get();
        return view('page.roles.insert', ['permissions'=>$permissions]);
    }

    public function InsertData(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'permission' => 'array',
        ]);

        // Create the new role
        $role = Role::create(['name' => $request->name]);

        // Attach selected permissions to the role
        if ($request->has('permission')) {
            $permissions = Permissions::whereIn('name', $request->permission)->pluck('id');
            $role->permissions()->attach($permissions);
        }

        return redirect()->route('role')->with('message', 'Role Insert Successfully');
    }

    // update
    public function Update($id) {
        $role = Role::find($id);

        return view('page.roles.edit', [
            'role'=>$role,
        ]);
    }

    public function DataUpdate(Request $request, $id) {
        $role = Role::find($id);
        $role->name = $request->input('name');

        $role->update();

        return redirect()->route('role')->with('message','Role Successfully');
    }

    // delete
    public function Delete(Request $request, $id){
        try {
            Role::destroy($request->id);
            return redirect()->route('role');
        } catch(\Exception $e) {
            report($e);
        }
    }
}
