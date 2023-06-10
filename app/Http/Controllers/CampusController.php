<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampusRequest;
use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CampusController extends Controller
{
    function indexList() {
        $campuses = Campus::all();
        return view('admin.campus.index', compact(['campuses']));
    }

    function create() {
        return view('admin.campus.create');
    }

    function insert(CampusRequest $request) {
        Campus::create([
            'name' => $request->name
        ]);
        return view('admin.campus.index')->with('success','Successfully added new campus!');
    }

    function edit($id) {
        $campus = Campus::find($id);
        return view('admin.campus.edit', compact(['campus']));
    }

    function update(CampusRequest $request, $id) {

        $campus = Campus::find($id);
        if(!$campus) {
            return Redirect::back()->with('error','Campus data not found!');
        }
        $campus->update([
            'name' => $request->name,
        ]);

        return view('admin.campus.index')->with('success','Successfully update campus information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:campuses,id',
        ];

        $request->validate($validation);
        Campus::destroy($request->id);

        return view('admin.campus.index')->with('success','Successfully deleted campus!');
    }
}
