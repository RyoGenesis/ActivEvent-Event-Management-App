<?php

namespace App\Http\Controllers;

use App\Http\Requests\MajorRequest;
use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Ladmin\Datatables\MajorDatatables;

class MajorController extends Controller
{
    function indexList() {
        if( request()->has('datatables') ) {
            return MajorDatatables::renderData();
        }

        return ladmin()->view('major.index');
    }

    function create() {
        $faculties = Faculty::all();
        return ladmin()->view('major.create', compact(['faculties']));
    }

    function insert(MajorRequest $request) {
        Major::create([
            'name' => $request->name,
            'faculty_id' => $request->faculty_id,
        ]);
        return redirect()->route('ladmin.major.index')->with('success','Successfully added new major!');
    }

    function edit($id) {
        $major = Major::with(['faculty'])->where('id',$id)->first();
        if(!$major) {
            return redirect()->route('ladmin.major.index')->with('danger','Major data not found!');
        }
        $faculties = Faculty::all();
        return ladmin()->view('major.edit', compact(['major', 'faculties']));
    }

    function update(MajorRequest $request, $id) {

        $major = Major::find($id);
        if(!$major) {
            return Redirect::back()->with('danger','Major data not found!');
        }
        $major->update([
            'name' => $request->name,
            'faculty_id' => $request->faculty_id,
        ]);

        return redirect()->route('ladmin.major.index')->with('success','Successfully update major information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:majors,id',
        ];

        $request->validate($validation);
        Major::destroy($request->id);

        return redirect()->back()->with('success','Successfully deleted major!');
    }
}
