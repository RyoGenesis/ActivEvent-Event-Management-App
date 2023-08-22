<?php

// use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Modules\Ladmin\Menus\Submenus\Role;

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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/eventdetail', function(){
//     return view('eventdetail');
// });

Route::get('/eventdetail/{id}', [App\Http\Controllers\EventController::class, 'eventdetail'])->name('eventdetail');

Route::get('/profile', function(){
    return view('profile');
});

// Route::get('/userevent', function(){
//     return view('userevent');
// });

Route::get('/prevevent', function(){
    return view('prevevent');
});

Route::get('/search/nama', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

Route::get('/latestevent', [App\Http\Controllers\EventController::class, 'latestevent'])->name('latestevent');

Route::get('/featuredevent', [App\Http\Controllers\EventController::class, 'featuredevent'])->name('featuredevent');

Route::middleware('auth')->group(function(){
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'userprofile'])->name('profile');
    Route::get('/editprofile', [App\Http\Controllers\UserController::class, 'showEditProfileForm'])->name('editprofile');
    Route::post('editprofile/update', [App\Http\Controllers\UserController::class, 'profileUpdate'])->name('editprofile.update');
});