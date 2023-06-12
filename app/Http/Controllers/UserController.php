<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //WIP
    function edit() {
        $user = Auth::user();
        $user->load(['campus','faculty','major','communities','categories']);
        return view('main.edit_profile', compact(['user']));
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

        return view('main.index')->with('success','Successfully update profile information!');
    }
}
