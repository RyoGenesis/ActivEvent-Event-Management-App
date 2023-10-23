<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\Campus;
use App\Models\Category;
use App\Models\Community;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Event;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Modules\Ladmin\Datatables\StudentUserDatatables;

class UserController extends Controller
{
    function indexList() {
        if( request()->has('datatables') ) {
            return StudentUserDatatables::renderData();
        }
        return ladmin()->view('student_user.index');
    }

    function adminCreate() {
        $campuses = Campus::all();
        $faculties = Faculty::all();
        $communities = Community::all();
        return ladmin()->view('student_user.create', compact(['campuses', 'faculties', 'communities']));
    }

    function adminInsert(UserRequest $request) {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'password' => Hash::make('b!Nu$password'),
            'campus_id' => $request->campus_id,
            'faculty_id' => $request->faculty_id,
            'major_id' => $request->major_id,
        ]);

        if($request->communities) {
            $user->communities()->sync($request->communities);
        }

        return redirect()->route('ladmin.student_user.index')->with('success','Successfully insert new student!');
    }

    function adminEdit($id) {
        $userStudent = User::with(['campus','faculty','major','communities'])->where('id',$id)->first();
        if(!$userStudent) {
            return redirect()->route('ladmin.student_user.index')->with('danger','Student data not found!');
        }
        $campuses = Campus::all();
        $faculties = Faculty::all();
        $communities = Community::all();
        $userCommunities = $userStudent->communities->pluck('id')->toArray();
        return ladmin()->view('student_user.edit', compact(['userStudent', 'campuses', 'faculties', 'communities', 'userCommunities']));
    }

    function profileUpdate(UserRequest $request) {

        $user = User::find(Auth::user()->id);
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'personal_email' => $request->personal_email,
            'campus_id' => $request->campus_id,
            'faculty_id' => $request->faculty_id,
            'major_id' => $request->major_id,
            'topics' => $request->topics ? $request->topics : null,
        ]);

        $user->communities()->sync($request->communities);
        $user->categories()->sync($request->categories);
        
        return redirect()->back()->with('success','Successfully update profile information!');
    }

    function adminUpdate(UserRequest $request, $id) {

        $user = User::find($id);
        if(!$user) {
            return Redirect::back()->with('danger','Student not found!');
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'campus_id' => $request->campus_id,
            'faculty_id' => $request->faculty_id,
            'major_id' => $request->major_id,
        ]);

        $comms = $request->communities ?? [];
        $user->communities()->sync($comms);

        return redirect()->route('ladmin.student_user.index')->with('success','Successfully update student information!');
    }

    public function deactivate(Request $request)
    {
        ladmin()->allows(['ladmin.student_user.destroy']);
        
        $user = User::find($request->id);
        if(!$user) {
            return Redirect::back()->with('danger','Student user not found!');
        }
        $user->delete();
        return redirect()->back()->with('success','Successfully deactivate student user!');

    }

    public function reactivate(Request $request)
    {
        ladmin()->allows(['ladmin.student_user.destroy']);
        
        $user = User::withTrashed()->find($request->id);
        if(!$user) {
            return Redirect::back()->with('danger','Student user not found!');
        }
        $user->restore();
        return redirect()->back()->with('success','Successfully re-activate student account!');
    }

    function passwordChangeIndex() {
        return view('main.profile.password_change');
    }

    function passwordChange(ChangePasswordRequest $request) {
        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success','Successfully changed password!');
    }

    function userprofile(){
        $user = User::with(['campus','faculty','major','communities','categories','events_upcoming','events_rejected'])->where('id',Auth::user()->id)->first();
        $upcomingEvents = $user->events_upcoming;
        $rejectedEvents = $user->events_rejected;
        $topicInterests = explode(',',$user->topics);
        return view('profile', compact(['user','upcomingEvents','rejectedEvents','topicInterests']));
    }

    function showEditProfileForm(){
        $user = User::with(['campus','faculty','major','communities','categories'])->find(Auth::user()->id);
        $userCommunities = $user->communities->pluck('id')->toArray();
        $preferredCategories = $user->categories->pluck('id')->toArray();
        $campuses = Campus::withTrashed()->whereNull('deleted_at')->orWhere('id', $user->campus_id)->get();
        $faculties = Faculty::withTrashed()->whereNull('deleted_at')->orWhere('id', $user->campus_id)->get();
        $communities = Community::withTrashed()->whereNull('deleted_at')->orWhereIn('id', $userCommunities)->where('id','!=',1)->get(); //get all except univ itself
        $categories = Category::withTrashed()->whereNull('deleted_at')->orWhereIn('id', $preferredCategories)->get();
        return view('editprofile', compact('user', 'campuses', 'faculties','communities','categories','userCommunities','preferredCategories'));
    }

    function historyevent(){
        $user = User::with('events.community')->where('id',Auth::user()->id)->first();
        $historyevents = $user->events;
        return view('historyevent', compact('user', 'historyevents'));
    }
}
