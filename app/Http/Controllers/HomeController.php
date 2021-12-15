<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class HomeController extends Controller
{
    public function HomeSlider(){
        $sliders = Slider::get();
        return view('admin.slider.index',compact('sliders'));
    }
    public function AddSlider(){
        return view('admin.slider.create');
    }
    public function StoreSlider(Request $request){

        $slider_image = $request->file('image');
        $name_generator = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        $up_location = 'image/slider/';
        $last_image = $up_location . $name_generator;

        Image::make($slider_image)->resize(1920, 1088)->save($last_image); //image intervention method


        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'New Slider Inserted');
    }

    public function EditSlider($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }
    
    public function UpdateSlider(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'title' => 'required|min:4',
                'image' => 'mimes:jpg,jpeg,png',
            ]
        );

        $old_image = $request->old_image;
        $last_image = $request->old_image;
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_generator = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_generator . '.' . $img_ext;
            $up_location = 'image/slider/';
            $last_image = $up_location . $img_name;
            $image->move($up_location, $img_name);

            unlink($old_image);
        }
        Slider::find($id)->Update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider Updated Successfully');
    }

    public function DeleteSlider($id)
    {
        $slider = Slider::find($id);
        $old_image = $slider->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->route('home.slider')->with('success', 'Slider Deleted Successfully');
    }
}
