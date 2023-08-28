<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

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
        // $activeevents=Event::join('user_event', 'events.id', '=', 'user_event.event_id')->where('events.status', 'like', '%Active%')->selectRaw('user_event.*', count(user_event.User))
        return view('home', compact('latestevents', 'featuredevents'));
    }

    public function search(Request $request){
        $search=$request->nama;
        $category=Category::all();
        $event=Event::where('name', 'like', "%".$search."%")->get();
        if($request->checkcomserv){
            $sat=$request->checkcomserv;
            $event = Event :: where('has_comserv', true)->whereIn('id', $event->pluck('id'))->get();
        }
        return view('search', compact('event', 'search', 'category'));
    }
}
