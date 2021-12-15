<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePassController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Multipic;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $first_about = DB::table('home_abouts')->first();
    $portfolio_images = Multipic::all();//same thing with E ORM method
    $services = Service::all();

    return view('home',compact('brands','first_about','portfolio_images','services'));
});

Route::get('/home', function () {
    echo "another brand new home page";
});

Route::get('/about', function () {
    return view('about');
});

//For Category Route
Route::get('/category/all', [CategoryController::class,'allCat'])->name('all.category');
Route::get('/category/edit/{id}', [CategoryController::class,'Edit']);
Route::get('/softdelete/category/{id}', [CategoryController::class,'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class,'Restore']);
Route::get('/category/destroy/{id}', [CategoryController::class,'Destroy']);
Route::post('/category/update/{id}', [CategoryController::class,'Update']);
Route::post('/category/add', [CategoryController::class,'addCat'])->name('add.category');

//For Brand Route
Route::get('/brand/all', [BrandController::class,'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class,'AddBrand'])->name('add.brand');
Route::get('/brand/edit/{id}', [BrandController::class,'Edit']);
Route::post('/brand/update/{id}', [BrandController::class,'Update']);
Route::get('/brand/delete/{id}', [BrandController::class,'Delete']);

//Multi Image Route
Route::get('/multi/image', [BrandController::class,'MultiPic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class,'AddMultiPics'])->name('store.images');


//Admin Home Slider All Route
Route::get('/home/slider', [HomeController::class,'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class,'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class,'StoreSlider'])->name('store.slider');
Route::get('/edit/slider/{id}', [HomeController::class,'EditSlider'])->name('edit.slider');
Route::post('/update/slider/{id}', [HomeController::class,'UpdateSlider']);
Route::get('/delete/slider/{id}', [HomeController::class,'DeleteSlider']);

//Admin Home About All Route
Route::get('/home/about', [AboutController::class,'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class,'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class,'StoreAbout'])->name('store.about');
Route::get('/edit/about/{id}', [AboutController::class,'EditAbout'])->name('edit.about');
Route::post('/update/about/{id}', [AboutController::class,'UpdateAbout']);
Route::get('/delete/about/{id}', [AboutController::class,'DeleteAbout']);

//Admin Home contact Route
Route::get('/profile/contact', [ContactController::class,'ProfileContact'])->name('profile.contact');
Route::get('/message/contact', [ContactController::class,'MessageContact'])->name('message.contact');
Route::get('/delete/message/{id}', [ContactController::class,'DeleteMessage'])->name('delete.message');
Route::get('/add/contact', [ContactController::class,'AddContact'])->name('add.contact');
Route::post('/store/contact', [ContactController::class,'StoreContact'])->name('store.contact');
Route::get('/edit/contact/{id}', [ContactController::class,'EditContact'])->name('edit.contact');
Route::post('/update/contact/{id}', [ContactController::class,'UpdateContact']);
Route::get('/delete/contact/{id}', [ContactController::class,'DeleteContact']);

//Admin Home Service All Route
Route::get('/home/service', [ServiceController::class,'HomeService'])->name('home.service');
Route::get('/add/service', [ServiceController::class,'AddService'])->name('add.service');
Route::post('/store/service', [ServiceController::class,'StoreService'])->name('store.service');
Route::get('/edit/service/{id}', [ServiceController::class,'EditService'])->name('edit.service');
Route::post('/update/service/{id}', [ServiceController::class,'UpdateService']);
Route::get('/delete/service/{id}', [ServiceController::class,'DeleteService']);

//change password and user profile route
Route::get('/change/password', [ChangePassController::class,'ChangePassword'])->name('change.password');
Route::post('/update/password', [ChangePassController::class,'UpdatePassword'])->name('update.password');
Route::get('/edit/profile', [ChangePassController::class,'EditProfile'])->name('edit.profile');
Route::post('/update/profile', [ChangePassController::class,'UpdateProfile'])->name('update.profile');

//Portfolio Home Page Route
 Route::get('/portfolio', [AboutController::class,'Portfolio'])->name('portfolio');

//Contact Home Page Route
 Route::get('/contact', [ContactController::class,'ContactPage'])->name('contact');
 Route::post('/form/contact',[ContactController::class,'FormContact'])->name('form.contact');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //$users = User::all();
    //$users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class,'Logout'])->name('user.logout');
