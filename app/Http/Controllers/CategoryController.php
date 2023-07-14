<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Ladmin\Datatables\CategoryDatatables;

class CategoryController extends Controller
{
    function indexList() {
        if( request()->has('datatables') ) {
            return CategoryDatatables::renderData();
        }

        return ladmin()->view('category.index');
    }

    function create() {
        return ladmin()->view('category.create');
    }

    function insert(CategoryRequest $request) {
        Category::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        return redirect()->route('ladmin.category.index')->with('success','Successfully added new category!');
    }

    function edit($id) {
        $category = Category::find($id);
        if(!$category) {
            return redirect()->route('ladmin.category.index')->with('danger','Category data not found!');
        }
        return ladmin()->view('category.edit', compact(['category']));
    }

    function update(CategoryRequest $request, $id) {

        $category = Category::find($id);
        if(!$category) {
            return Redirect::back()->with('danger','Category data not found!');
        }
        $category->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);

        return redirect()->route('ladmin.category.index')->with('success','Successfully update category information!');
    }

    function destroy(Request $request) {

        $validation = [
            "id"=>'required|integer|exists:categories,id',
        ];

        $request->validate($validation);
        Category::destroy($request->id);

        return redirect()->back()->with('success','Successfully deleted category!');
    }
}
