<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function Color(Request $request) {

        $search_value = $request->query("search");
        $rowLength = $request->query('row_length', 10);
        $colors = Color::paginate($rowLength);
        return view('page.colors.index', ['colors'=>$colors, 'search_value'=>$search_value]);
    }

    public function Insert() {
        return view('page.colors.insert');
    }

    public function InsertData(Request $request) {
        
        $color = new Color();
        $color->color_code = $request->input("color_code");
        $color->color_name = $request->input("color_name");
        $color->save();

        return redirect()->route('color')->with('message', 'Color Inserted Successfully');
    }

    // update 
    public function Update($id) {

        $color = Color::find($id);
        return view('page.colors.edit', ['color' => $color]);
    }

    public function DataUpdate(Request $request, $id) {

        $color = Color::find($id);
        $color->color_code = $request->input("color_code");
        $color->color_name = $request->input("color_name");
        $color->update();
        
        return redirect()->route('color')->with('message','Color Updated Successfully');
    }

    // delete 
    public function Delete(Request $request, $id){
        try {   
            Color::destroy($request->id);
            return redirect()->route('storage');
        } catch(\Exception $e) {
            report($e);
        }
    }
}
