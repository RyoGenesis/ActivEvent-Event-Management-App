<?php

namespace Modules\Ladmin\Http\Controllers;

use App\Models\Event;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Charts\AnalyticChart;
use Modules\Ladmin\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, AnalyticChart $chart)
    {
        //get relevant events info
        $user = auth()->user();
        $latestActive = Event::with(['community','category']);
        $nearClosing = Event::with(['community','category']);
        $recentlyFinished = Event::with(['community','category']);
        $latestUpdated = Event::with(['community','category']);
        $waitingApproval = Event::with(['community','category']);
        $communities = Community::all();

        if($user->community_id != 1) { //only get events that is related to admin community
            $latestActive = $latestActive->where('community_id',$user->community_id);
            $nearClosing = $nearClosing->where('community_id',$user->community_id);
            $recentlyFinished = $recentlyFinished->where('community_id',$user->community_id);
            $latestUpdated = $latestUpdated->where('community_id',$user->community_id);
            $waitingApproval = $waitingApproval->where('community_id',$user->community_id);
        }

        $latestActive = $latestActive->where('status','Active')->whereDate('date','>',now())->latest()->take(3)->get();
        $nearClosing = $nearClosing->where('status','Active')->whereDate('date','>',now())->orderBy('date','ASC')->take(3)->get();
        $recentlyFinished = $recentlyFinished->where('status','Active')->whereDate('date','<',now())->orderBy('date','DESC')->take(3)->get();
        $latestUpdated = $latestUpdated->orderBy('updated_at','DESC')->take(3)->get();
        $waitingApproval = $waitingApproval->where('status','Draft')->oldest()->take(3)->get();
        $groupby_community = isset($request->groupby_community)?($request->groupby_community):'';
        $charts = $chart->build($user, $groupby_community);

        return ladmin()->view('dashboard.index', compact(['latestActive','nearClosing','recentlyFinished','latestUpdated','waitingApproval','charts', 'communities', 'user']));
    }
}
