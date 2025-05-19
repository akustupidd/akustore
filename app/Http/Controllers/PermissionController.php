<?php

namespace App\Http\Controllers;

use App\Models\PermissionKey;
use App\Models\Permissions;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function Permission(Request $request) {
    $search = $request->query('search');
    $rowLength = $request->query('row_length', 10);

    $query = Permissions::query();

    if ($search) {
        $query->where('name', 'LIKE', '%' . $search . '%');
    }

    $permissions = $query->paginate($rowLength)->withQueryString();

    return view('page.permissions.index', [
        'permissions' => $permissions,
        'search_value' => $search,
    ]);
}


    public function Insert() {
        $permission_keys = PermissionKey::$permission_key;
        return view('page.permissions.insert', ['permission_keys'=>$permission_keys]);
    }

    public function InsertData(Request $request) {
        $permission = new Permissions();
        $permission->name = $request->input('name');
        $permission->key = $request->input('key');

        $permission->save();
        return redirect()->route('permission')->with('message', 'Permission Inserted Successfully');
    }

    // update
    public function Update($id) {
        $permission = Permissions::find($id);
        $permission_keys = PermissionKey::$permission_key;

        return view('page.permissions.edit', [
            'permission'=>$permission,
            'permission_keys'=>$permission_keys
        ]);
    }

    public function DataUpdate(Request $request, $id) {
        $permission = Permissions::find($id);
        $permission->name = $request->input('name');
        $permission->key = $request->input('key');

        $permission->update();

        return redirect()->route('permission')->with('message','Permission Updated Successfully');
    }

    // delete
    public function Delete(Request $request, $id){
        try {
            Permissions::destroy($request->id);
            return redirect()->route('permission');
        } catch(\Exception $e) {
            report($e);
        }
    }
}
