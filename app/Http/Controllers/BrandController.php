<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'Please Enter brand Name.',
                'brand_name.min' => 'Brand Name must be more than 4 characters.',
            ]
        );

        $brand_image = $request->file('brand_image');
        $name_generator = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        $up_location = 'image/brand/';
        $last_image = $up_location . $name_generator;

        //$brand_image->move($up_location,$name_generator);//simple method
        Image::make($brand_image)->resize(300, 200)->save($last_image); //image intervention method


        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_image,
            'created_at' => Carbon::now()
        ]);

        $notification = array('message'=> 'Brand Inserted Successfully',
                               'alert-type'=> 'success');
        return Redirect()->back()->with($notification);
    }

    public function Edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|min:4',
                'brand_image' => 'mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'Please Enter brand Name.',
                'brand_name.min' => 'Brand Name must be more than 4 characters.',
            ]
        );

        $old_image = $request->old_image;
        $last_image = $request->old_image;
        if ($request->file('brand_image')) {
            $brand_image = $request->file('brand_image');
            $name_generator = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_generator . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_image = $up_location . $img_name;
            $brand_image->move($up_location, $img_name);

            unlink($old_image);
        }
        Brand::find($id)->Update([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_image,
            'created_at' => Carbon::now()
        ]);
        $notification = array('message'=> 'Brand Updated Successfully',
                               'alert-type'=> 'info');
        return Redirect()->route('all.brand')->with($notification);
    }

    public function Delete($id)
    {
        $brand = Brand::find($id);
        $old_image = $brand->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        $notification = array('message'=> 'Brand Deleted Successfully',
                               'alert-type'=> 'error');
        return Redirect()->route('all.brand')->with($notification);
    }

    public function MultiPic()
    {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function AddMultiPics(Request $request)
    {

        $images = $request->file('images');

        foreach ($images as $image) {
            $name_generator = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $up_location = 'image/multi/';
            $last_image = $up_location . $name_generator;

            Image::make($image)->resize(300, 300)->save($last_image); //image intervention method

            Multipic::insert([
                'image' => $last_image,
                'created_at' => Carbon::now()
            ]);
        }
        $notification = array('message'=> 'Images Uploaded',
                               'alert-type'=> 'success');
        return Redirect()->back()->with($notification);
    }

    public function Logout(){
        Auth::logout();
        $notification = array('message'=> 'User Loged Out',
                               'alert-type'=> 'info');
        return Redirect()->route('login')->with($notification);
    }
}
