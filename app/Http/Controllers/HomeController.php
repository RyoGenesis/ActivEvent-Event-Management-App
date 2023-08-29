<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // buat login
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latestevents=Event::where('status', 'Active')->orderBy('created_at', 'DESC')->limit(9)->get();
        $featuredevents=Event::where([['status', 'Active'], ['is_highlighted', true]])->limit(9)->get();
        if(Auth::check()){
            $user = User::find(Auth::user()->id);
            $topicInterests = explode(',',$user->topics);
            foreach($topicInterests as $interest){
                $recomendedevents[$interest] = Event::where('topic', 'like', "%".$interest."%")->get();
            }
            return view('home', compact('latestevents', 'featuredevents', 'recomendedevents', 'topicInterests'));
        }
        else{
            return view('home', compact('latestevents', 'featuredevents'));
        }
    }
}
