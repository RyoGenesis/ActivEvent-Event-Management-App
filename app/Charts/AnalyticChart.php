<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use \App\Models\Event;
use \App\Models\Category;
use App\Models\Community;
use PDO;

class AnalyticChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
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

        return $this->chart->pieChart()
            ->setTitle('Report Event Per ' .$value)
            ->addData($list_total_user)
            ->setLabels($list_sort_label);
    }
}
