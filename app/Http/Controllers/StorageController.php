<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Storage;

class StorageController extends Controller
{
    public function Storage(Request $request) {

        $storages = Storage::paginate($request->query('row_length', 10));

        return view('page.storages.index', ['storages'=>$storages]);
    }

    public function Insert() {
        return view('page.storages.insert');
    }

    public function InsertData(Request $request) {
        
        $storage = new Storage();
        $storage->size = $request->input("size");
        $storage->save();

        return redirect()->route('storage')->with('message', 'Storage Inserted Successfully');
    }

    // update 
    public function Update($id) {

        $storage = Storage::find($id);

        return view('page.storages.edit', ['storage' => $storage]);
    }

    public function DataUpdate(Request $request, $id) {

        $storage = Storage::find($id);
        $storage->size = $request->input("size");
        $storage->update();
        
        return redirect()->route('storage')->with('message','storage Updated Successfully');
    }

    // delete 
    public function Delete(Request $request, $id){
        try {   
            Storage::destroy($request->id);
            return redirect()->route('storage');
        } catch(\Exception $e) {
            report($e);
        }
    }
}
