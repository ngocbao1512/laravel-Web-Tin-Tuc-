<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::name('client.')->prefix('client')->group(function () {
    Route::get('/about', function () {
        return view('client.my-directory.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('client.my-directory.contact');
    })->name('contact');

    Route::get('/index', function () {
        return view('client.my-directory.index');
    })->name('index');

    Route::get('/post', function () {
        return view('client.my-directory.post');
    })->name('post');

});

Route::name('admin.')->prefix('admin')->middleware('locale')->group(function () {

   
    Route::get('blogs',[AdminBlogController::class,'index'])->name('blogs');
    Route::post('blogs/destroy',[AdminBlogController::class,'destroy'])->name('blogs.destroy');
    Route::post('blogs/store',[AdminBlogController::class,'store'])->name('blogs.store');
    Route::post('blogs/update',[AdminBlogController::class,'update'])->name('blogs.update');
    Route::post('blogs/show',[AdminBlogController::class,'show'])->name('blogs.show');

    //Route::resource('users', AdminUserController::class);
    Route::get('users',[AdminUserController::class,'index'])->name('users');
    Route::get('users/$userid',[AdminUserController::class,'show'])->name('users.show');
    Route::post('users/destroy',[AdminUserController::class,'destroy'])->name('users.destroy');
    Route::post('users/store',[AdminUserController::class,'store'])->name('users.store');
    Route::post('users/user',[AdminUserController::class,'update'])->name('users.update');
    Route::post('users/find',[AdminUserController::class,'find'])->name('users.find');
    Route::post('users/getmodal',[AdminUserController::class,'getModal'])->name('users.getmodal');

    //change language
    Route::post('change-language',[HomeController::class,'changeLanguage'])->name('user.change-language');

});

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
