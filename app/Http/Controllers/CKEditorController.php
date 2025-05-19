<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;
class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/ckeditor'), $filename);
            $url = asset('uploads/ckeditor/' . $filename);

            return response()->json([
                "uploaded" => 1,
                "fileName" => $filename,
                "url" => $url
            ]);
        }
        return response()->json(["uploaded" => 0, "error" => ["message" => "Upload failed"]]);
    }
}
