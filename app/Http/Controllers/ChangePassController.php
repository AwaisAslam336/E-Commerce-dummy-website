<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class ChangePassController extends Controller
{
    public function ChangePassword()
    {
        return view('admin.body.change_password');
    }
    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password Changed');
        } else {
            return redirect()->back()->with('error', 'Invalid Current Password');
        }
    }

    public function EditProfile()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            
            if ($user) {
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if ($user) {
            $user->name = $request['name'];
            $user->email = $request['email'];
            //image part
            $old_image = $request->old_image;
            $last_image = $request->old_image;
            if ($request->file('photo')) {
                $photo = $request->file('photo');
                $name_generator = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
                $up_location = 'image/profile/';
                $last_image = $up_location . $name_generator;
                Image::make($photo)->resize(180, 180)->save($last_image); //image intervention method

                if($old_image){
                    unlink($old_image);
                }
            }


            $user->profile_photo_path = $last_image;
            $user->save();
            return Redirect()->route('dashboard')->with('success', 'User Profile is Updated');
        } else {
            return Redirect()->back();
        }
    }
}
