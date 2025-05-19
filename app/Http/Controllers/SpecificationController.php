<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specification;
use App\Models\Product;

class SpecificationController extends Controller
{
    public function Specification(Request $request) {
        $products = Product::all();
        $search_value = $request->query("search");
        $rowLength = $request->query('row_length', 10);
        $specifications = Specification::join('products', 'specifications.product_id', '=', 'products.id')
        ->select('specifications.*', 'products.name as product_name')
        ->where('products.name', 'like', '%'.$request->query("product_name").'%')
        ->where('specifications.title', 'like', '%'.$request->input('search').'%')
        ->paginate($rowLength);
        
        return view('page.specifications.index', [
            'specifications'=>$specifications,
            'search_value'=>$search_value,
            'products'=>$products
        ]);
    }

    public function Insert() {
        $products = Product::all();

        return view('page.specifications.insert', ['products' => $products]);
    }

    public function InsertData(Request $request) {

        $specification = new Specification();
        $specification->title = $request->input("title");
        $specification->description = $request->input("description");
        $specification->product_id = $request->input("product_id");
        $specification->save();

        return redirect()->route('specification')->with('message', 'Specification Inserted Successfully');
    }

    // update 
    public function Update($id) {

        $specification = Specification::find($id);
        $products = Product::all();

        return view('page.specifications.edit', ['products'=>$products, 'specification' => $specification]);
    }

    public function DataUpdate(Request $request, $id) {

        $specification = Specification::find($id);
        $specification->title = $request->input("title");
        $specification->description = $request->input("description");
        $specification->product_id = $request->input("product_id");
        $specification->update();
        
        return redirect()->route('specification')->with('message','Specification Updated Successfully');
    }

    // delete 
    public function Delete(Request $request, $id){
        try {
            Specification::destroy($request->id);
            return redirect()->route('specification');
        } catch(\Exception $e) {
            report($e);
        }
    }
}
