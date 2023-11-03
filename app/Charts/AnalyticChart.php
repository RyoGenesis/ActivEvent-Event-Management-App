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

    public function build($value)
    {
        if($value == 'category' || empty($value)){
            $sorts = Category::all();
            $search = 'category_id';
            $value = 'category';
        }

        else if($value == 'community'){
            $sorts = Community::all();
            $search = 'community_id';
        }

        $list_sort_label = array();
        $list_total_user = array();

        foreach($sorts as $sort){
            $events_persort = Event::where($search, $sort->id)->get();

            $total_users = 0;

            foreach($events_persort as $event){
                $count_users = $event->users->count();
                $total_users += $count_users;
            }
            $list_sort_label[] = $sort->name;
            $list_total_user[] = $total_users;
        }

        $pie_chart = $this->chart->pieChart()
        ->setTitle('Report Event Per ' .$value)
        ->addData($list_total_user)
        ->setLabels($list_sort_label);

        $bar_chart = $this->chart2->barChart()
        ->setTitle('Testing Bar Chart')
        ->addData('Jakarta', [40, 50, 40]);

        return [$pie_chart, $bar_chart];
    }
}
