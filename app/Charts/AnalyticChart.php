<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use \App\Models\Event;
use \App\Models\Category;
use App\Models\Community;
use PDO;

class AnalyticChart
{
    protected $chart, $chart2, $chart3;

    public function __construct(LarapexChart $chart, LarapexChart $chart2, LarapexChart $chart3)
    {
        $this->chart = $chart;
        $this->chart2 = $chart2;
        $this->chart3 = $chart3;
    }

    public function build($user,$value_community)
    {
        $categories = Category::all();
        $communities = Community::all();
        
        $list_label_chart = array();
        $list_total_user_chart = array();
        
        if(empty($value_community)){
            foreach($categories as $category){
                $category_events = Event::where('category_id', $category->id)->get();
                $total = 0;
                foreach($category_events as $category_event){
                    $count = $category_event->users->where('pivot.status','Registered')->count();
                    $total += $count;
                }

                $list_label_chart[] = $category->name;
                $list_total_user_chart[] = $total;
            }
        }
        else{
            foreach($categories as $category){
                $category_events = Event::where('community_id', $value_community)->where('category_id', $category->id)->get();
                $total = 0;
                foreach($category_events as $category_event){
                    $count = $category_event->users->where('pivot.status','Registered')->count();
                    $total += $count;
                }
                $list_label_chart[] = $category->name;
                $list_total_user_chart[] = $total;
            }
        }

        $list_sort_label_piechart = array();
        $list_total_user_piechart = array();

        foreach($communities as $community){
            $events_percommunity = Event::where('community_id', $community->id)->get();

            $total_users = 0;

            foreach($events_percommunity as $event_percommunity){
                $count_users = $event_percommunity->users->where('pivot.status','Registered')->count();
                $total_users += $count_users;
            }
            $list_sort_label_piechart[] = $community->name;
            $list_total_user_piechart[] = $total_users;
        }

        $list_label_barchart = array();
        $list_total_user_barchart = array();

        foreach($categories as $category){
            $community_events = Event::where('community_id', $user->community_id)->where('category_id', $category->id)->get();
            $total_user = 0;
            foreach($community_events as $community_event){
                $count_user = $community_event->users->where('pivot.status','Registered')->count();
                $total_user += $count_user;
            }
            $list_label_barchart[] = $category->name;
            $list_total_user_barchart[] = $total_user;
        }
        
        $chart = $this->chart->pieChart()
        ->setTitle('Total Event Participants Per Category')
        ->addData($list_total_user_chart)
        ->setLabels($list_label_chart);

        $pie_chart = $this->chart2->pieChart()
        ->setTitle('Total Event Participants Per Community')
        ->addData($list_total_user_piechart)
        ->setLabels($list_sort_label_piechart);

        $bar_chart = $this->chart3->barChart()
        ->setTitle('Total Participants From Your Community')
        ->addData('Participants', $list_total_user_barchart)
        ->setXAxis($list_label_barchart);
        
        if($user->community_id == 1){
            return [$chart, $pie_chart, $bar_chart];
        }
        else{
            return [$bar_chart];
        }

    }
}
