<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use \App\Models\Event;
use \App\Models\Category;
use App\Models\Community;
use PDO;

class AnalyticChart
{
    protected $chart, $chart2;

    public function __construct(LarapexChart $chart, LarapexChart $chart2)
    {
        $this->chart = $chart;
        $this->chart2 = $chart2;
    }

    public function build($value_groupby, $user)
    {
        $categories = Category::all();
        $communities = Community::all();

        


        if($value_groupby == 'category' || empty($value_groupby)){
            $sorts = $categories;
            $search = 'category_id';
            $value_groupby = 'category';
        }

        else if($value_groupby == 'community'){
            $sorts = $communities;
            $search = 'community_id';
        }

        $list_sort_label_piechart = array();
        $list_total_user_piechart = array();

        foreach($sorts as $sort){
            $events_persort = Event::where($search, $sort->id)->get();

            $total_users = 0;

            foreach($events_persort as $event){
                $count_users = $event->users->count();
                $total_users += $count_users;
            }
            $list_sort_label_piechart[] = $sort->name;
            $list_total_user_piechart[] = $total_users;
        }

        $community_user = Community::select('name')->where('id', $user->community_id)->get();

        // dd($community_user->attribute);

        $list_label_barchart = array();
        $list_total_user_barchart = array();

        foreach($categories as $category){
            $community_events = Event::where('community_id', $user->community_id)->where('category_id', $category->id)->get();
            $total_user = 0;
            foreach($community_events as $community_event){
                $count_user = $community_event->users->count();
                $total_user += $count_user;
            }
            $list_label_barchart[] = $category->name;
            $list_total_user_barchart[] = $total_user;
        }

        $pie_chart = $this->chart->pieChart()
        ->setTitle('Report Event Per ' .$value_groupby)
        ->addData($list_total_user_piechart)
        ->setLabels($list_sort_label_piechart);

        $bar_chart = $this->chart2->barChart()
        ->setTitle('Report Total Participant Which Events You Created')
        ->addData('a', $list_total_user_barchart)
        ->setXAxis($list_label_barchart);

        return [$pie_chart, $bar_chart];
    }
}
