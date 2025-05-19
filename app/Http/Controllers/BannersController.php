<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banners;

class BannersController extends Controller
{
    public function Banner(Request $request) {
        $search_value = $request->query("search");
        $rowLength = $request->query('row_length', 10);
    
        $banners = Banners::query()
            ->when($search_value, function ($query, $search_value) {
                $query->where('title', 'like', '%' . $search_value . '%');
            })
            ->paginate($rowLength);
    
        return view('page.banners.banner', [
            'banners' => $banners,
            'search_value' => $search_value,
        ]);
    }

    public function Insert() {
        return view('page.banners.insert');
    }

    public function InsertData(Request $request) {
        $banners = new Banners();
        $banners->title = $request->input('title');
        $banners->sub_title = $request->input('sub_title');
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.'.$extension;
            $file->move('uploads/banners', $filename);
            $banners->image = $filename;
        }
        $banners->save();
        return redirect()->route('banner')->with('message', 'Slide Banner Inserted Successfully');
    }

    
    // update 
    public function Update($id) {
        $banner = Banners::find($id);
        return view('page.banners.edit', ['banner'=>$banner]);
    }

    public function DataUpdate(Request $request, $id) {
        $banner = Banners::find($id);
        $banner->title = $request->input('title');
        $banner->sub_title = $request->input('sub_title');
        if($request->hasFile('image'))
        {
            $destination = 'uploads/banner'. $banner->image;
            if(Banners::exists($destination))
            {
                Banners::destroy($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.'.$extension;
            $file->move('uploads/banners', $filename);
            $banner->image = $filename;
            
        }
        $banner->update();
        
        return redirect()->route('banner')->with('message','Slide Banner Updated Successfully');
    }

    // delete 
    public function Delete(Request $request, $id)
    {
        try {
            $banner = Banners::findOrFail($id);
    
            // Check if the banner image exists and delete it
            $imagePath = public_path('uploads/banners/' . $banner->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
    
            // Delete the banner record from the database
            $banner->delete();
    
            // Return with a success message
            return redirect()->route('banner')->with('message', 'Banner deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            report($e);
    
            // Return with an error message
            return redirect()->route('banner')->with('error', 'Failed to delete the banner. Please try again.');
        }
    }
    
}
