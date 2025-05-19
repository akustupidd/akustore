<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Ram;

class RamController extends Controller
{
    public function Ram(Request $request) {
        $search_value = $request->query("search");
        $rowLength = $request->query('row_length', 10);
        $rams = Ram::paginate($rowLength);

        return view('page.rams.index', ['rams'=>$rams, 'search_value'=>$search_value]);
    }

    public function Insert() {
        return view('page.rams.insert');
    }

    public function InsertData(Request $request) {
        
        $ram = new Ram();
        $ram->size = $request->input("size");
        $ram->save();

        return redirect()->route('ram')->with('message', 'Ram Inserted Successfully');
    }

    // update 
    public function Update($id) {

        $ram = Ram::find($id);
        $products = Product::all();

        return view('page.rams.edit', ['products'=>$products, 'ram' => $ram]);
    }

    public function DataUpdate(Request $request, $id) {

        $ram = Ram::find($id);
        $ram->size = $request->input("size");
        $ram->product_id = $request->input("product_id");
        $ram->update();
        
        return redirect()->route('ram')->with('message','Ram Updated Successfully');
    }

    // delete 
    public function Delete(Request $request, $id){
        try {
            Ram::destroy($request->id);
            return redirect()->route('ram');
        } catch(\Exception $e) {
            report($e);
        }
    }
}
