<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function Account(Request $request) {
        $user = Auth::guard('admin')->user();
        return view('account-setting.account', ['user'=>$user]);
    }

    public function UpdateData(Request $request) {
        $user = Auth::guard('admin')->user();
        $user = Admin::find($user->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->username = $request->input('username');
        $user->phone_number = $request->input('phone_number');
        if($request->hasFile('image'))
        {
            $destination = 'uploads/users'. $user->image;
            if(Admin::exists($destination))
            {
                Admin::destroy($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.'.$extension;
            $file->move('uploads/users', $filename);
            $user->image = $filename;
            
        }
        $user->save();
        return redirect()->route('account')->with('message', 'Update is successfully !');
    }

     // delete 
     public function DeleteAccount(Request $request){
        $user = Auth::guard('admin')->user();
        try {
            Admin::destroy($user->id);
            return redirect()->route('sign-in');
        } catch(\Exception $e) {
            report($e);
        }
    }
}
