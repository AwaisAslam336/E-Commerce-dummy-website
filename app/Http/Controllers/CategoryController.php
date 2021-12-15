<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allCat()
    {
        $categories = Category::latest()->paginate(5); //E ORM method
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        //$categories= DB::table('categories')->latest()->paginate(5);//query builder method

        //    $categories= DB::table('categories')
        //         ->join('users','categories.user_id','users.id')
        //         ->select('categories.*','users.name')
        //         ->latest()->paginate(5);   //query builder method to join Table

        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function addCat(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ], [
            'category_name.required' => 'Please Enter Category Name.',
            'category_name.max' => 'Category Name must be less than 255 characters.',
        ]);

        Category::insert([
            'category_name' => $request->category_name, //1st category_name is table column name--2nd category_name is form input field name
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        // $category = new Category();
        // $category->category_name= $request->category_name;
        // $category->user_id= Auth::user()->id;
        // $category->save();

        // $data = array();
        // $data['category_name']=$request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'New Category Inserted');
    }

    public function Edit($id)
    {
        //$category = Category::find($id);
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function Update(Request $request, $id)
    {
        // $update = Category::find($id)->Update([
        //     'category_name'=> $request->category_name,
        //     'user_id'=> Auth::user()->id
        // ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    }

    public function SoftDelete($id)
    {
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category Soft Deleted Successfully');
    }

    public function Restore($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restored Successfully');
    }

    public function Destroy($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category Permanently Deleted');
    }
}
