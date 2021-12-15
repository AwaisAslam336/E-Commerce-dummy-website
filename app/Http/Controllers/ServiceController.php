<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    public function HomeService(){
        $services = Service::get();
        return view('admin.service.index',compact('services'));
    }

    public function AddService(){
        return view('admin.service.create');
    }

    public function StoreService(Request $request){

        $icon = $request->file('icon');
        $name_generator = hexdec(uniqid()) . '.' . $icon->getClientOriginalExtension();
        $up_location = 'image/service/';
        $last_image = $up_location . $name_generator;

        Image::make($icon)->resize(64, 64)->save($last_image); //image intervention method


        Service::insert([
            'title' => $request->title,
            'service_des' => $request->service_des,
            'icon' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.service')->with('success', 'New Service Inserted');
    }

    public function EditService($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
    }
    
    public function UpdateService(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'title' => 'required|min:4',
                'icon' => 'mimes:jpg,jpeg,png',
            ]
        );

        $old_image = $request->old_image;
        $last_image = $request->old_image;
        if ($request->file('icon')) {
            $image = $request->file('icon');
            $name_generator = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_generator . '.' . $img_ext;
            $up_location = 'image/service/';
            $last_image = $up_location . $img_name;
            $image->move($up_location, $img_name);

            unlink($old_image);
        }
        Service::find($id)->Update([
            'title' => $request->title,
            'service_des' => $request->service_des,
            'icon' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.service')->with('success', 'Service Updated Successfully');
    }

    public function DeleteService($id)
    {
        $service = Service::find($id);
        $old_image = $service->icon;
        unlink($old_image);

        Service::find($id)->delete();
        return Redirect()->route('home.service')->with('success', 'Service Deleted Successfully');
    }
}
