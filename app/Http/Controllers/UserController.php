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
        ]);

        return view('main.index')->with('success','Successfully update profile information!');
    }
}
