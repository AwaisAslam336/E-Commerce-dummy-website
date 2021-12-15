<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function HomeAbout(){
        $abouts= HomeAbout::get();
        return view('admin.about.index',compact('abouts'));
    }
    public function AddAbout(){
        return view('admin.about.create');
    }

    public function StoreAbout(Request $request){

        HomeAbout::insert([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success', 'New About Content Inserted');
    }

    public function EditAbout($id)
    {
        $about = HomeAbout::find($id);
        return view('admin.about.edit', compact('about'));
    }

    public function UpdateAbout(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'title' => 'required|min:4',
                'short_des' => 'required|min:14',
                'long_des' => 'required|min:40',
            ]
        );
        HomeAbout::find($id)->Update([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success', 'About Content Updated Successfully');
    }

    public function DeleteAbout($id)
    {
        HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success', 'About Content Deleted Successfully');
    }

    public function Portfolio(){
        $portfolio_images = Multipic::all();
        return view('pages.portfolio',compact('portfolio_images'));
    }
}
