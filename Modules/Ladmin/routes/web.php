<?php

use App\Http\Controllers\CampusController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Modules\Ladmin\Http\Controllers\AdminController;
use Modules\Ladmin\Http\Controllers\Auth\LoginController;
use Modules\Ladmin\Http\Controllers\DashboardController;
use Modules\Ladmin\Http\Controllers\GroupSearchController;
use Modules\Ladmin\Http\Controllers\NotificationController;
use Modules\Ladmin\Http\Controllers\PermissionController;
use Modules\Ladmin\Http\Controllers\ProfileController;
use Modules\Ladmin\Http\Controllers\RoleController;
use Modules\Ladmin\Http\Controllers\SystemLogController;
use Modules\Ladmin\Http\Controllers\UserActivityController;

/*
|--------------------------------------------------------------------------
| Ladmin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

ladmin()->route(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', DashboardController::class)->name('index');
    Route::resource('/notification', NotificationController::class)->only(['index', 'show', 'store']);
    Route::resource('/admin', AdminController::class)->except(['destroy', 'show']);
    Route::resource('/profile', ProfileController::class)->only(['index', 'store']);
    Route::resource('/role', RoleController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('/permission', PermissionController::class)->only(['update']);
    Route::resource('/activities', UserActivityController::class)->only(['index', 'show', 'destroy']);
    Route::resource('/systemlog', SystemLogController::class)->only(['index', 'destroy']);

    // campus
    Route::get('campus', [CampusController::class, 'indexList'])->name('campus.index');
    Route::get('campus/create', [CampusController::class, 'create'])->name('campus.create');
    Route::post('campus', [CampusController::class, 'store'])->name('campus.store');
    Route::get('campus/{id}/edit', [CampusController::class, 'edit'])->name('campus.edit');
    Route::post('campus/{id}', [CampusController::class, 'update'])->name('campus.update');
    Route::post('campus/{id}/delete', [CampusController::class, 'destroy'])->name('campus.destroy');

    // category
    Route::get('category', [CategoryController::class, 'indexList'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('category/{id}/delete', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/group-search', GroupSearchController::class)->name('group.search');
});
