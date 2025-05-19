<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    public function ProductType(Request $request) {
        $products_type = ProductType::paginate(10);
        return view('page.products-type.index', ['products_type'=>$products_type]);
    }

    public function Insert() {
        return view('page.products-type.insert');
    }

    public function InsertData(Request $request) {
        $products_type = new ProductType();
        $products_type->name = $request->input('name');
        $products_type->save();
        return redirect()->route('product-type')->with('message', 'Products Type Inserted Successfully');
    }

    // update 
    public function Update($id) {
        $product_type = ProductType::find($id);
        return view('page.products-type.edit', ['product_type'=>$product_type]);
    }

    public function DataUpdate(Request $request, $id) {
        $product_type = ProductType::find($id);
        $product_type->name = $request->input('name');
        $product_type->update();
        
        return redirect()->route('product-type')->with('message','Product Type Updated Successfully');
    }

    // delete 
    public function Delete(Request $request, $id){
        try {
            ProductType::destroy($request->id);
            return redirect()->route('product-type');
        } catch(\Exception $e) {
            report($e);
        }
    }
}
