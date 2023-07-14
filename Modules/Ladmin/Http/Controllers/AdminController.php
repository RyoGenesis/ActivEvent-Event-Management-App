<?php

namespace Modules\Ladmin\Http\Controllers;

use App\Models\Community;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Ladmin\Datatables\AdminDatatables;
use Modules\Ladmin\Http\Controllers\Controller;
use Modules\Ladmin\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        ladmin()->allows(['ladmin.admin.index']);
        /**
         * Sometimes we need more than one table on a page. 
         * You can also create custom routes for rendering data from datatables. 
         * Ladmin uses the index route as a simple example.
         * 
         * Look at the \Modules\Ladmin\Datatables\AdminDatatables file in the ajax method
         */
        if( request()->has('datatables') ) {
            return AdminDatatables::renderData();
        }

        return ladmin()->view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ladmin()->allows(['ladmin.admin.create']);
        $communities = Community::all();
        return ladmin()->view('admin.create', compact('communities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        ladmin()->allows(['ladmin.admin.create']);
        
        return $request->adminCreate();
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        ladmin()->allows(['ladmin.admin.update']);

        $admin = ladmin()->admin()->find($id);
        if(!$admin) {
            return redirect()->route('ladmin.admin.index')->with('danger','Admin data not found!');
        }
        $communities = Community::all();
        return ladmin()->view('admin.edit', compact(['admin','communities']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        ladmin()->allows(['ladmin.admin.update']);
        
        return $request->updateAdmin(
            ladmin()->admin()->findOrFail($id)
        );

    }

    public function deactivate(Request $request)
    {
        ladmin()->allows(['ladmin.admin.deactivate']);
        
        $admin = ladmin()->admin()->findOrFail($request->id);
        $admin->update(['deactivated_at' => Carbon::now()]);
        session()->flash('success', 'Successfully deactivate admin account!');
        return redirect()->back();

    }

    public function reactivate(Request $request)
    {
        ladmin()->allows(['ladmin.admin.deactivate']);
        
        $admin = ladmin()->admin()->findOrFail($request->id);
        $admin->update(['deactivated_at' => null]);
        session()->flash('success', 'Successfully re-activate admin account!');
        return redirect()->back();

    }
    
}
