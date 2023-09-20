<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
                    ->whereDate('date','>',now())
                    ->orderBy('created_at', 'DESC')->limit(6)->get();
        $featuredEvents = Event::with('community')->where([['status', 'Active'], ['is_highlighted', true]])
                        ->whereDate('date','>',now())
                        ->orderBy('created_at', 'DESC')->limit(6)->get();
        $popularEvents = Event::with('community')->withCount('users')
                        ->where('status', 'Active')
                        ->whereDate('date','>',now())
                        ->orderBy('users_count','DESC')->orderBy('created_at', 'DESC')->limit(6)->get();
        if(Auth::check()){
            $user = User::find(Auth::user()->id);

            // dd($user->categories->pluck('id'));

            $recommendedEvents = Event::with('community')->where('status','Active')->whereDate('date','>',now());

            $recommendedEvents = $recommendedEvents->where(function ($q) use ($user) {

                $topicInterests = explode(',',$user->topics);

                //get by user communities
                $q = $q->whereIn('community_id', $user->communities->pluck('id'))
                    //get by user major
                    ->orWhereHas('majors', function (Builder $qu) use ($user){
                        $qu->where('id', $user->major_id);
                    })
                    //get by user category interest
                    ->orWhereIn('category_id', $user->categories->pluck('id'));
                
                //get by interest topics
                foreach($topicInterests as $interest){
                    $q = $q->orWhere('topic', 'like', "%".$interest."%")->orWhere('name', 'like', "%".$interest."%");
                }
            });
            
            $recommendedEvents = $recommendedEvents->orderBy('created_at', 'DESC')->limit(6)->get();
            return view('home', compact('latestEvents', 'featuredEvents', 'popularEvents', 'recommendedEvents'));
        }
        else{
            return view('home', compact('latestEvents', 'featuredEvents','popularEvents'));
        }
    }
}
