<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommunityRequest;
use App\Models\Community;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Ladmin\Datatables\CommunityDatatables;

class CommunityController extends Controller
{
    function indexList() {
        if( request()->has('datatables') ) {
            return CommunityDatatables::renderData();
        }

        return ladmin()->view('community.index');
    }

    function create() {
        $majors = Major::all();
        return ladmin()->view('community.create', compact(['majors']));
    }

    function insert(CommunityRequest $request) {
        $community = Community::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);

        if($request->majors) { //if majors array not empty
            $community->majors()->attach($request->majors);
        }

        return redirect()->route('ladmin.community.index')->with('success','Successfully added new community!');
    }

    function edit($id) {
        $community = Community::with(['majors'])->where('id',$id)->first();
        $communityMajors = $community->majors->pluck('id')->toArray();
        $majors = Major::all();
        return ladmin()->view('community.edit', compact(['community', 'communityMajors' ,'majors']));
    }

    function update(CommunityRequest $request, $id) {

        $community = Community::find($id);
        if(!$community) {
            return Redirect::back()->with('danger','Community data not found!');
        }
        $community->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);

        //update majors association
        $majors = $request->majors ?? []; //if null then empty array
        $community->majors()->sync($majors);

        return redirect()->route('ladmin.community.index')->with('success','Successfully update community information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:communities,id',
        ];

        $request->validate($validation);

        $community = Community::with('admins')->where('id', $request->id)->first();
        if(!$community->admins->where('deactivated_at',null)->isEmpty()) {
            return redirect()->back()->with('danger','Community can not be deleted. There are active admin users still associated with this');
        }

        Community::destroy($request->id);

        return redirect()->route('ladmin.community.index')->with('success','Successfully deleted community!');
    }
}
