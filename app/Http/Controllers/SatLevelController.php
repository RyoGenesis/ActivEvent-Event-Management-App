<?php

namespace App\Http\Controllers;

use App\Models\SatLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SatLevelController extends Controller
{
    function indexList() {
        $sat_levels = SatLevel::all();
        return view('admin.sat_level.index', compact(['sat_levels']));
    }

    function create() {
        return view('admin.sat_level.create');
    }

    function insert(Request $request) {
        SatLevel::create([
            'name' => $request->name
        ]);
        return view('admin.sat_level.index')->with('success','Successfully added new SAT level!');
    }

    function edit($id) {
        $satLevel = SatLevel::find($id);
        return view('admin.satLevel.edit', compact(['satLevel']));
    }

    function update(Request $request, $id) {

        $satLevel = SatLevel::find($id);
        if(!$satLevel) {
            return Redirect::back()->with('error','SAT level data not found!');
        }
        $satLevel->update([
            'name' => $request->name,
        ]);

        return view('admin.sat_level.index')->with('success','Successfully update information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:sat_levels,id',
        ];

        $request->validate($validation);
        SatLevel::destroy($request->id);

        return view('admin.sat_level.index')->with('success','Successfully deleted SAT level!');
    }
}
