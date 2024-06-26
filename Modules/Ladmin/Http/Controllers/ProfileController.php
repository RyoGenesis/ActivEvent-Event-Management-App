<?php

namespace Modules\Ladmin\Http\Controllers;

use App\Models\Community;
use Illuminate\Support\Facades\Hash;
use Modules\Ladmin\Http\Controllers\Controller;
use Modules\Ladmin\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = auth()->user();
        $data['communities'] = Community::where('id', auth()->user()->community_id)->get();
        return ladmin()->view('profile.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $data = [
            'username' => $request->username,
            'display_name' => $request->display_name,
        ];
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }
        auth()->user()->update($data);

        return redirect()->back()->with('success', 'Profile has been updated!');
    }

}
