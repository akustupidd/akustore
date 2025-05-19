<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Blog;

class ProfileController extends Controller
{
    public function Profile()
    {
        $user = Auth::user();
        $posts = Blog::orderBy('created_at', 'desc')->take(2)->get();

        return view('web-page.profile.index', ['user' => $user, 'posts' => $posts]);
    }

    public function UpdateData(Request $request)
    {
        // Get the authenticated user
        $user = Auth::guard('customer')->user();
        $user = Customer::find($user->id);

        // Update user basic info
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->phone_number = $request->input('phone_number');
        $user->dob = $request->input('dob');

        // Handle image upload and crop
        if ($request->has('image')) {
            $imageData = $request->input('image'); // Base64 encoded image data

            // Remove Base64 prefix dynamically using regex
            $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
            $decodedImage = base64_decode($imageData);

            // Check if the Base64 data is valid
            if ($decodedImage === false) {
                return redirect()->route('profile')->withErrors('Invalid image data.');
            }

            // Define destination path
            $destinationPath = 'uploads/users/';
            $extension = strpos($request->input('image'), 'jpeg') !== false ? 'jpg' : 'png';
            $fileName = time() . '.' . $extension;

            // Save the image to the disk
            $filePath = public_path($destinationPath . $fileName);
            if (!file_put_contents($filePath, $decodedImage)) {
                return redirect()->route('profile')->withErrors('Failed to save the image.');
            }

            // Verify the image is valid by checking its MIME type
            if (!exif_imagetype($filePath)) {
                // Delete invalid file
                unlink($filePath);
                return redirect()->route('profile')->withErrors('Uploaded file is not a valid image.');
            }

            // If there is an existing image, delete it
            if ($user->image && file_exists(public_path($destinationPath . $user->image))) {
                unlink(public_path($destinationPath . $user->image));
            }

            // Save the new image filename
            $user->image = $fileName;
        }

        // Save the updated user data
        $user->save();

        // Redirect back with success message
        return redirect()->route('profile')->with('message', 'Update is successfully!');
    }


}
