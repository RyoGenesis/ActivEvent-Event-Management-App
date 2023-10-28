<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use \App\Models\Event;
use \App\Models\Category;
use PDO;

class AnalyticChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $categories = Category::all();
        $list_data = array();
        $List_category = array();
        $list_total_user = array();

        foreach($categories as $category){
            $events_percategory = Event::where('category_id', $category->id)->get();

            $total_users = 0;

            foreach($events_percategory as $event){
                $count_users = $event->users->count();
                $total_users += $count_users;
            }
            $list_data[] = ['category_name'=>$category->name, 'total_users'=>$total_users];
            $list_category[] = $category->name;
            $list_total_user[] = $total_users;
        }
        return $this->chart->pieChart()
            ->setTitle('Report Event Per Category')
            ->addData($list_total_user)
            ->setLabels($list_category);
    }
}
