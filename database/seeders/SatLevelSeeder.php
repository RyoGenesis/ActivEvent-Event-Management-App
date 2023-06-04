<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "Regional",],
            ["name" => "",],
            ["name" => "",],
            ["name" => "",],
            ["name" => "International",],
        ];
        DB::table("sat_levels")->insert($data);
    }
}
