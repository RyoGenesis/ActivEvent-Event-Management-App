<?php

// use Illuminate\Support\Facades\App;

use App\Models\Event;
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

Route::get('/contactus', function(){
    return view('contactus');
})->name('contactus');

Route::get('/eventdetail/{id}', [App\Http\Controllers\EventController::class, 'eventdetail'])->name('eventdetail');

Route::get('/search', [App\Http\Controllers\EventController::class, 'search'])->name('search');

Route::get('/latestevent', [App\Http\Controllers\EventController::class, 'latestevent'])->name('latestevent');

Route::get('/featuredevent', [App\Http\Controllers\EventController::class, 'featuredevent'])->name('featuredevent');

Route::get('/popularevent', [App\Http\Controllers\EventController::class, 'popularevent'])->name('popularevent');

Route::middleware('auth')->group(function(){
    Route::get('recommendedevent', [App\Http\Controllers\EventController::class, 'recommendedevent'])->name('recommendedevent');
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'userprofile'])->name('profile');
    Route::get('/changepassword', function(){
        return view('changepassword');
    })->name('changepassword');
    Route::get('/event-history', [App\Http\Controllers\UserController::class, 'eventHistory'])->name('eventhistory');
    Route::get('/editprofile', [App\Http\Controllers\UserController::class, 'showEditProfileForm'])->name('editprofile');
    Route::post('editprofile/update', [App\Http\Controllers\UserController::class, 'profileUpdate'])->name('editprofile.update');
    Route::post('/changepassword/update', [App\Http\Controllers\UserController::class, 'passwordChange'])->name('changepassword.update');
    Route::post('/registration', [App\Http\Controllers\EventController::class, 'register'])->name('registration');
    Route::post('/cancelregistration', [App\Http\Controllers\EventController::class, 'cancelRegistration'])->name('cancelregistration');
});

Route::post('/test-email', [App\Http\Controllers\EventController::class, 'testingEmail'])->name('email.test');

Route::get('/email', function(){
    $event = Event::first();
    return view('mail.reminder')->with('data', $event);
})->name('email');

