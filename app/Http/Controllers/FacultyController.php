<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRequest;
use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Ladmin\Datatables\FacultyDatatables;

class FacultyController extends Controller
{
    function indexList() {
        if( request()->has('datatables') ) {
            return FacultyDatatables::renderData();
        }

        return ladmin()->view('faculty.index');
    }

    function create() {
        return ladmin()->view('faculty.create');
    }

    function insert(FacultyRequest $request) {
        Faculty::create([
            'name' => $request->name
        ]);
        return redirect()->route('ladmin.faculty.index')->with('success','Successfully added new faculty!');
    }

    function edit($id) {
        $faculty = Faculty::find($id);
        if(!$faculty) {
            return redirect()->route('ladmin.faculty.index')->with('danger','Faculty data not found!');
        }
        return ladmin()->view('faculty.edit', compact(['faculty']));
    }

    function update(FacultyRequest $request, $id) {

        $faculty = Faculty::find($id);
        if(!$faculty) {
            return Redirect::back()->with('danger','Faculty data not found!');
        }
        $faculty->update([
            'name' => $request->name,
        ]);

        return redirect()->route('ladmin.faculty.index')->with('success','Successfully update faculty information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:faculties,id',
        ];

        $request->validate($validation);
        Faculty::destroy($request->id);

        return redirect()->back()->with('success','Successfully deleted faculty!');
    }

    function getMajors(Request $request) {

        $majors = Major::where('faculty_id',$request->id)->get();        
        return $majors;
    }
}
