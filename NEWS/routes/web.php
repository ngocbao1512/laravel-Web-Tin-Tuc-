<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
//use App\Http\Controllers\Admin\Dashboard;

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
        return view('client.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('client.contact');
    })->name('contact');

    Route::get('/index', function () {
        return view('client.index');
    })->name('index');

    Route::get('/post', function () {
        return view('client.post');
    })->name('post');

});

//->middleware('auth')
Route::name('admin.')->prefix('admin')->group(function () {

    //Route::get('/dashboard', Dashboard::class)->name('dashboard');

   Route::resource('blogs', AdminBlogController::class);

});