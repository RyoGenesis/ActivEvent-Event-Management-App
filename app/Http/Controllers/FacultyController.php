<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRequest;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FacultyController extends Controller
{
    function indexList() {
        $faculties = Faculty::all();
        return view('admin.faculty.index', compact(['faculties']));
    }

    function create() {
        return view('admin.faculty.create');
    }

    function insert(FacultyRequest $request) {
        Faculty::create([
            'name' => $request->name
        ]);
        return view('admin.faculty.index')->with('success','Successfully added new faculty!');
    }

    function edit($id) {
        $faculty = Faculty::find($id);
        return view('admin.faculty.edit', compact(['faculty']));
    }

    function update(FacultyRequest $request, $id) {

        $faculty = Faculty::find($id);
        if(!$faculty) {
            return Redirect::back()->with('error','Faculty data not found!');
        }
        $faculty->update([
            'name' => $request->name,
        ]);

        return view('admin.faculty.index')->with('success','Successfully update faculty information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:faculties,id',
        ];

        $request->validate($validation);
        Faculty::destroy($request->id);

        return view('admin.faculty.index')->with('success','Successfully deleted faculty!');
    }

    function getMajors(Request $request) {

        $faculty = Faculty::where('id',$request->id)->first();
        $majors = $faculty->majors;
        
        return $majors;
    }
}
