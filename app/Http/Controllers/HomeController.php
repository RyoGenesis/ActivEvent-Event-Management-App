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
        $latestEvents = Event::with('community')->where('status', 'Active')
                    // ->whereDate('date','>',now())
                    ->orderBy('created_at', 'DESC')->limit(6)->get();
        $featuredEvents = Event::with('community')->where([['status', 'Active'], ['is_highlighted', true]])
                        // ->whereDate('date','>',now())
                        ->orderBy('created_at', 'DESC')->limit(6)->get();
        $popularEvents = Event::with('community')->withCount('users')
                        ->where('status', 'Active')
                        // ->whereDate('date','>',now())
                        ->orderBy('users_count','DESC')->orderBy('created_at', 'DESC')->limit(6)->get();
        if(Auth::check()){
            $user = User::find(Auth::user()->id);

            dd($user->communities->pluck('id'));

            $recommendedEvents = Event::with('community')->where('status','Active')->whereDate('date','>',now());

            //get by user communities
            $recommendedEvents = $recommendedEvents->orWhereIn('community_id', $user->communities->pluck('id'));

            //get by user major
            $recommendedEvents = $recommendedEvents;

            //get by user category interest
            $recommendedEvents = $recommendedEvents;

            //get by interest topics
            $topicInterests = explode(',',$user->topics);
            foreach($topicInterests as $interest){
                $recommendedEvents = $recommendedEvents->orWhere('topic', 'like', "%".$interest."%");
            }
            $recommendedEvents = $recommendedEvents->orderBy('created_at', 'DESC')->limit(6)->get();
            return view('home', compact('latestEvents', 'featuredEvents', 'popularEvents', 'recommendedEvents'));
        }
        else{
            return view('home', compact('latestEvents', 'featuredEvents','popularEvents'));
        }
    }
}
