<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BgaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "Global Standard Technical Competencies",],
            ["name" => "Digital & Technology Fluency",],
            ["name" => "Applied Management Skills",],
            ["name" => "Critical & Creative Thinking",],
            ["name" => "Adaptability",],
            ["name" => "Initiative",],
            ["name" => "Growth Mindset",],
            ["name" => "Collaboration",],
            ["name" => "Social Awareness",],
        ];
        DB::table("bgas")->insert($data);
    }
}
