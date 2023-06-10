<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommunityRequest;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommunityController extends Controller
{
    function indexList() {
        $communities = Community::all();
        return view('admin.community.index', compact(['communities']));
    }

    function create() {
        return view('admin.community.create');
    }

    function insert(CommunityRequest $request) {
        Community::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        return view('admin.community.index')->with('success','Successfully added new community!');
    }

    function edit($id) {
        $community = Community::find($id);
        return view('admin.community.edit', compact(['community']));
    }

    function update(CommunityRequest $request, $id) {

        $community = Community::find($id);
        if(!$community) {
            return Redirect::back()->with('error','Community data not found!');
        }
        $community->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);

        return view('admin.community.index')->with('success','Successfully update community information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:communities,id',
        ];

        $request->validate($validation);
        Community::destroy($request->id);

        return view('admin.community.index')->with('success','Successfully deleted community!');
    }
}
