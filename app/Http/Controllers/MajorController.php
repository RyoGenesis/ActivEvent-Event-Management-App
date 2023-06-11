<?php

namespace App\Http\Controllers;

use App\Http\Requests\MajorRequest;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MajorController extends Controller
{
    function indexList() {
        $majors = Major::all();
        return view('admin.major.index', compact(['majors']));
    }

    function create() {
        return view('admin.major.create');
    }

    function insert(MajorRequest $request) {
        Major::create([
            'name' => $request->name,
            'faculty_id' => $request->faculty_id,
        ]);
        return view('admin.major.index')->with('success','Successfully added new major!');
    }

    function edit($id) {
        $major = Major::find($id);
        return view('admin.major.edit', compact(['major']));
    }

    function update(MajorRequest $request, $id) {

        $major = Major::find($id);
        if(!$major) {
            return Redirect::back()->with('error','Major data not found!');
        }
        $major->update([
            'name' => $request->name,
            'faculty_id' => $request->faculty_id,
        ]);

        return view('admin.major.index')->with('success','Successfully update major information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:majors,id',
        ];

        $request->validate($validation);
        Major::destroy($request->id);

        return view('admin.major.index')->with('success','Successfully deleted major!');
    }
}
