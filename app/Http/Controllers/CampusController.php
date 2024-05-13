<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampusRequest;
use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Ladmin\Datatables\CampusDatatables;

class CampusController extends Controller
{
    function indexList() {
        if( request()->has('datatables') ) {
            return CampusDatatables::renderData();
        }

        return ladmin()->view('campus.index');
    }

    function create() {
        return ladmin()->view('campus.create');
    }

    function insert(CampusRequest $request) {
        Campus::create([
            'name' => $request->name
        ]);
        return redirect()->route('ladmin.campus.index')->with('success','Successfully added new campus!');
    }

    function edit($id) {
        $campus = Campus::find($id);
        if(!$campus) {
            return redirect()->route('ladmin.campus.index')->with('danger','Campus data not found!');
        }
        return ladmin()->view('campus.edit', compact(['campus']));
    }

    function update(CampusRequest $request, $id) {

        $campus = Campus::find($id);
        if(!$campus) {
            return Redirect::back()->with('danger','Campus data not found!');
        }
        $campus->update([
            'name' => $request->name,
        ]);

        return redirect()->route('ladmin.campus.index')->with('success','Successfully update campus information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:campuses,id',
        ];

        $request->validate($validation);
        Campus::destroy($request->id);

        return redirect()->back()->with('success','Successfully deleted campus!');
    }
}
