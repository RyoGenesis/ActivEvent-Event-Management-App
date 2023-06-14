<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\Campus;
use App\Models\Category;
use App\Models\Community;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function profileIndex() {
        $user = User::with(['campus','faculty','major','communities','categories','events_upcoming','events_rejected'])->where('id',Auth::user()->id)->first();
        $upcomingEvents = $user->events_upcoming;
        $rejectedEvents = $user->events_rejected;
        return view('main.profile.index', compact(['user','upcomingEvents','rejectedEvents']));
    }

    function edit() {
        $user = User::with(['campus','faculty','major','communities','categories'])->where('id',Auth::user()->id)->first();
        $campuses = Campus::all();
        $faculties = Faculty::all();
        $communities = Community::all();
        $categories = Category::all();
        return view('main.profile.edit', compact(['user', 'campuses', 'faculties', 'communities', 'categories']));
    }

    function adminEdit($id) {
        $userStudent = User::with(['campus','faculty','major','communities'])->where('id',$id)->first();
        $campuses = Campus::all();
        $faculties = Faculty::all();
        $communities = Community::all();
        return view('admin.student_users.edit', compact(['userStudent', 'campuses', 'faculties', 'communities']));
    }

    function update(UserRequest $request) {

        $user = User::find(Auth::user()->id);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'campus_id' => $request->campus_id,
            'faculty_id' => $request->faculty_id,
            'major_id' => $request->major_id,
            'topics' => $request->topics ? implode(',',$request->topics) : null,
        ]);

        $user->communities()->sync($request->communities);
        $user->categories()->sync($request->categories);

        return view('main.profile.index')->with('success','Successfully update profile information!');
    }

    function passwordChangeIndex() {
        return view('main.profile.password_change');
    }

    function passwordChange(ChangePasswordRequest $request) {
        $user = User::find(Auth::user()->id);

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return view('main.profile.index')->with('success','Successfully update new password!');
    }
}
