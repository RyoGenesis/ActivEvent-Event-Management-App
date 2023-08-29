<?php

use App\Http\Controllers\CampusController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SatLevelController;
use App\Http\Controllers\UserController;
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
    Route::resource('/role', RoleController::class)->only(['index', 'create', 'show', 'store', 'edit', 'update']);
    Route::resource('/permission', PermissionController::class)->only(['update']);
    Route::resource('/activities', UserActivityController::class)->only(['index', 'show', 'destroy']);
    Route::resource('/systemlog', SystemLogController::class)->only(['index', 'destroy']);

    Route::post('admin/deactivate', [AdminController::class, 'deactivate'])->name('admin.deactivate');
    Route::post('admin/reactivate', [AdminController::class, 'reactivate'])->name('admin.reactivate');

    // campus
    Route::get('campus', [CampusController::class, 'indexList'])->name('campus.index');
    Route::get('campus/create', [CampusController::class, 'create'])->name('campus.create');
    Route::post('campus', [CampusController::class, 'insert'])->name('campus.store');
    Route::post('campus/delete', [CampusController::class, 'destroy'])->name('campus.destroy');
    Route::get('campus/{id}/edit', [CampusController::class, 'edit'])->name('campus.edit');
    Route::post('campus/{id}', [CampusController::class, 'update'])->name('campus.update');

    // faculty
    Route::get('faculty', [FacultyController::class, 'indexList'])->name('faculty.index');
    Route::get('faculty/create', [FacultyController::class, 'create'])->name('faculty.create');
    Route::post('faculty', [FacultyController::class, 'insert'])->name('faculty.store');
    Route::post('faculty/delete', [FacultyController::class, 'destroy'])->name('faculty.destroy');
    Route::get('faculty/{id}/edit', [FacultyController::class, 'edit'])->name('faculty.edit');
    Route::post('faculty/{id}', [FacultyController::class, 'update'])->name('faculty.update');

    // major
    Route::get('major', [MajorController::class, 'indexList'])->name('major.index');
    Route::get('major/create', [MajorController::class, 'create'])->name('major.create');
    Route::post('major', [MajorController::class, 'insert'])->name('major.store');
    Route::post('major/delete', [MajorController::class, 'destroy'])->name('major.destroy');
    Route::get('major/{id}/edit', [MajorController::class, 'edit'])->name('major.edit');
    Route::post('major/{id}', [MajorController::class, 'update'])->name('major.update');

    // category
    Route::get('category', [CategoryController::class, 'indexList'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category', [CategoryController::class, 'insert'])->name('category.store');
    Route::post('category/delete', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/{id}', [CategoryController::class, 'update'])->name('category.update');

    // community
    Route::get('community', [CommunityController::class, 'indexList'])->name('community.index');
    Route::get('community/create', [CommunityController::class, 'create'])->name('community.create');
    Route::post('community', [CommunityController::class, 'insert'])->name('community.store');
    Route::post('community/delete', [CommunityController::class, 'destroy'])->name('community.destroy');
    Route::get('community/{id}/edit', [CommunityController::class, 'edit'])->name('community.edit');
    Route::post('community/{id}', [CommunityController::class, 'update'])->name('community.update');

    // student-users
    Route::get('student-user', [UserController::class, 'indexList'])->name('student_user.index');
    Route::get('student-user/create', [UserController::class, 'adminCreate'])->name('student_user.create');
    Route::post('student-user', [UserController::class, 'adminInsert'])->name('student_user.store');
    Route::post('student-user/deactivate', [UserController::class, 'destroy'])->name('student_user.destroy');
    Route::post('student-user/reactivate', [UserController::class, 'reactivate'])->name('student_user.reactivate');
    Route::get('student-user/{id}/edit', [UserController::class, 'adminEdit'])->name('student_user.edit');
    Route::post('student-user/{id}', [UserController::class, 'adminUpdate'])->name('student_user.update');

    //event
    Route::get('event', [EventController::class, 'indexList'])->name('event.index');
    Route::get('highlight/event', [EventController::class, 'highlightIndex'])->name('event.highlight.index');
    Route::get('highlight/event/create', [EventController::class, 'highlightCreate'])->name('event.highlight.create');
    Route::post('highlight/event', [EventController::class, 'highlightInsert'])->name('event.highlight.store');
    Route::post('highlight/event/remove', [EventController::class, 'highlightRemove'])->name('event.highlight.remove');
    Route::get('approval/event', [EventController::class, 'approveIndex'])->name('event.approval.index');
    Route::post('approval/event/approve', [EventController::class, 'approve'])->name('event.approval.post');
    Route::get('event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('event', [EventController::class, 'insert'])->name('event.store');
    Route::post('event/delete', [EventController::class, 'destroy'])->name('event.destroy');
    Route::get('event/{id}', [EventController::class, 'showView'])->name('event.show');
    Route::get('event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::post('event/{id}', [EventController::class, 'update'])->name('event.update');
    Route::get('event/{id}/participants', [EventController::class, 'viewParticipant'])->name('event.participant.index');
    Route::post('event/{id}/participants/reject', [EventController::class, 'rejectParticipant'])->name('event.participant.reject');
    Route::get('event/{id}/participants/download', [EventController::class, 'downloadData'])->name('event.participant.download');

    // sat_level
    // Route::get('sat-level', [SatLevelController::class, 'indexList'])->name('sat_level.index');
    // Route::get('sat-level/create', [SatLevelController::class, 'create'])->name('sat_level.create');
    // Route::post('sat-level', [SatLevelController::class, 'insert'])->name('sat_level.store');
    // Route::post('sat-level/delete', [SatLevelController::class, 'destroy'])->name('sat_level.destroy');
    // Route::get('sat-level/{id}/edit', [SatLevelController::class, 'edit'])->name('sat_level.edit');
    // Route::post('sat-level/{id}', [SatLevelController::class, 'update'])->name('sat_level.update');

    // Route::get('/group-search', GroupSearchController::class)->name('group.search');
});
