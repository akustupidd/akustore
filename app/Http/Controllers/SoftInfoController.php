<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoftInfo;
use App\Models\Product;

class SoftInfoController extends Controller
{
    public function SoftInfo(Request $request) {
        $search_value = $request->query("search");
        $rowLength = $request->query('row_length', 10);
        $softinfos = SoftInfo::join('products', 'softinfo.product_id', '=', 'products.id')
        ->select('softinfo.*', 'products.name as product_name')
        ->where('products.name', 'like', '%'.$request->input('search').'%')
        ->paginate($rowLength);
        return view('page.soft-infos.index', ['softinfos'=>$softinfos, 'search_value'=>$search_value]);
    }

    public function Insert() {
        $products = Product::all();
        return view('page.soft-infos.insert', ['products'=>$products]);
    }

    public function InsertData(Request $request) {
        $softinfo = new SoftInfo();
        $softinfo->product_id = $request->input('product_id');
        $softinfo->level = $request->input('level');
        $softinfo->description = $request->input('description');
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.'.$extension;
            $file->move('uploads/softinfos', $filename);
            $softinfo->icon = $filename;
        }
    
        $softinfo->save();
        return redirect()->route('soft-info')->with('message', 'Soft Info Inserted Successfully');
    }

    // update 
    public function Update($id) {

        $softinfo = SoftInfo::find($id);
        $products = Product::all();

        return view('page.soft-infos.edit', ['softinfo'=>$softinfo, 'products'=>$products]);
    }

    public function DataUpdate(Request $request, $id) {
        $softinfo = SoftInfo::find($id);
        $softinfo->product_id = $request->input('product_id');
        $softinfo->level = $request->input('level');
        $softinfo->description = $request->input('description');
        if($request->hasFile('image'))
        {
            $destination = 'uploads/softinfos/'. $softinfo->icon;
            if(SoftInfo::exists($destination))
            {
                SoftInfo::destroy($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.'.$extension;
            $file->move('uploads/softinfos/', $filename);
            $softinfo->icon = $filename;
            
        }
        $softinfo->update();
        
        return redirect()->route('soft-info')->with('message','Soft Info Updated Successfully');
    }

    // delete 
    public function Delete(Request $request, $id){
        try {
            SoftInfo::destroy($request->id);
            return redirect()->route('soft-info');
        } catch(\Exception $e) {
            report($e);
        }
    }
}
