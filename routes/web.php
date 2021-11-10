<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

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
App::bind('UserRepositoryInterface', 'DbUserRepository');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


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

Route::name('admin.')->prefix('admin')->group(function () {

   Route::resource('blogs', AdminBlogController::class);


   //Route::resource('users', AdminUserController::class);
   Route::get('users',[AdminUserController::class,'index'])->name('users');
   Route::get('users/$userid',[AdminUserController::class,'show'])->name('users.show');
   Route::post('users/destroy',[AdminUserController::class,'destroy'])->name('users.destroy');
   Route::post('users/store',[AdminUserController::class,'store'])->name('users.store');
   Route::post('users/user',[AdminUserController::class,'update'])->name('users.update');
   Route::post('users/find',[AdminUserController::class,'find'])->name('users.find');
   Route::post('users/getmodal',[AdminUserController::class,'getModal'])->name('users.getmodal');

});