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
            ["name" => "Training", "display_name" => "Training Program"],
            ["name" => "Talkshow", "display_name" => "Talkshow"],
            ["name" => "Keagamaan", "display_name" => "Keagamaan"],
            ["name" => "Pertunjukan", "display_name" => "Pertunjukan"],
            ["name" => "Campaign", "display_name" => "Campaign"],
            ["name" => "Konferensi", "display_name" => "Konferensi"],
            ["name" => "Volunteer Work", "display_name" => "Volunteer Work"],
            ["name" => "Kompetisi", "display_name" => "Kompetisi"],
            ["name" => "Rekreasi", "display_name" => "Rekreasi"],
            ["name" => "Festival", "display_name" => "Festival"],
            ["name" => "Expo", "display_name" => "Expo"],
            ["name" => "Pameran", "display_name" => "Pameran"],
        ];
        DB::table("categories")->insert($data);
    }
}
