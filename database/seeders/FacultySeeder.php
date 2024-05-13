<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "School of Computer Science",], //1
            ["name" => "School of Information Systems",], //2
            ["name" => "School of Design",], //3
            ["name" => "Business School",], //4
            ["name" => "School of Accounting",], //5
            ["name" => "Faculty of Humanities",], //6
            ["name" => "Faculty of Engineering",], //7
            ["name" => "Faculty of Digital Communication and Hotel and Tourism",], //8
            ["name" => "Binus ASO School of Engineering",], //9
            ["name" => "Graduate Program",], //10
        ];
        DB::table("faculties")->insert($data);
    }
}
