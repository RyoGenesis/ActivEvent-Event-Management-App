<?php

namespace Modules\Ladmin\Http\Controllers;

use App\Models\Event;
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
        $groupby_chart = isset($request->groupby_value)?($request->groupby_value):'';
        $charts = $chart->build($groupby_chart);

        return ladmin()->view('dashboard.index', compact(['latestActive','nearClosing','recentlyFinished','latestUpdated','waitingApproval','charts']));
    }
}
