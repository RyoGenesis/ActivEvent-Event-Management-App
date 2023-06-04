<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "Kemanggisan",],
            ["name" => "Alam Sutera",],
            ["name" => "Senayan",],
            ["name" => "Bekasi",],
            ["name" => "Bandung",],
            ["name" => "Malang",],
            ["name" => "Semarang",],
        ];
        DB::table("campuses")->insert($data);
    }
}
