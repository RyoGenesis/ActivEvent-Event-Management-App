<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "Seminar", "display_name" => "Seminar"],
            ["name" => "Workshop", "display_name" => "Workshop"],
            ["name" => "Keagamaan", "display_name" => "Keagamaan"],
            ["name" => "Festival", "display_name" => "Festival"],
            ["name" => "Expo", "display_name" => "Expo"],
        ];
        DB::table("categories")->insert($data);
    }
}
