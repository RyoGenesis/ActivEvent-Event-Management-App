<?php

namespace App\Http\Controllers;

use App\Models\SatLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Ladmin\Datatables\SatLevelDatatables;

class SatLevelController extends Controller
{
    function indexList() {
        if( request()->has('datatables') ) {
            return SatLevelDatatables::renderData();
        }

        return ladmin()->view('sat_level.index');
    }

    function create() {
        return ladmin()->view('sat_level.create');
    }

    function insert(Request $request) {
        SatLevel::create([
            'name' => $request->name
        ]);
        return redirect()->route('ladmin.sat_level.index')->with('success','Successfully added new SAT level!');
    }

    function edit($id) {
        $satLevel = SatLevel::find($id);
        if(!$satLevel) {
            return redirect()->route('ladmin.sat_level.index')->with('danger','SAT level data not found!');
        }
        return ladmin()->view('sat_level.edit', compact(['satLevel']));
    }

    function update(Request $request, $id) {

        $satLevel = SatLevel::find($id);
        if(!$satLevel) {
            return Redirect::back()->with('danger','SAT level data not found!');
        }
        $satLevel->update([
            'name' => $request->name,
        ]);

        return redirect()->route('ladmin.sat_level.index')->with('success','Successfully update information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:sat_levels,id',
        ];

        $request->validate($validation);
        SatLevel::destroy($request->id);

        return redirect()->back()->with('success','Successfully deleted SAT level!');
    }
}
