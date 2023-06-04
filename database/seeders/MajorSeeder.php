<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "Computer Science", 'faculty_id' => '1',], //1
            ["name" => "Cyber Security", 'faculty_id' => '1',], //2
            ["name" => "Data Science", 'faculty_id' => '1',], //3
            ["name" => "Mobile Application and Technology", 'faculty_id' => '1',], //4
            ["name" => "Game Application and Technology", 'faculty_id' => '1',], //5
            ["name" => "Computer Science and Mathematics", 'faculty_id' => '1',], //6
            ["name" => "Computer Science and Statistics", 'faculty_id' => '1',], //7

            ["name" => "Information Systems", 'faculty_id' => '2',], //8
            ["name" => "Information Systems Global Class", 'faculty_id' => '2',], //9
            ["name" => "Information Systems and Accounting", 'faculty_id' => '2',], //10
            ["name" => "Information Systems Accounting and Auditing", 'faculty_id' => '2',], //11
            ["name" => "Business Information Technology", 'faculty_id' => '2',], //12
            ["name" => "Computerized Auditing", 'faculty_id' => '2',], //13
            ["name" => "Information Systems Audit", 'faculty_id' => '2',], //14
            ["name" => "Information Systems and Management", 'faculty_id' => '2',], //15
            ["name" => "Business Analytics", 'faculty_id' => '2',], //16

            ["name" => "Visual Communication Design", 'faculty_id' => '3',], //17
            ["name" => "Interior Design", 'faculty_id' => '3',], //18
            ["name" => "Film", 'faculty_id' => '3',], //19
            ["name" => "Visual Communication Design New Media", 'faculty_id' => '3',], //20
            ["name" => "Visual Communication Design Animation", 'faculty_id' => '3',], //21
            ["name" => "Visual Communication Design Creative Advertising", 'faculty_id' => '3',], //22

            ["name" => "Business Management", 'faculty_id' => '4',], //23
            ["name" => "Management", 'faculty_id' => '4',], //24
            ["name" => "Global Business Marketing", 'faculty_id' => '4',], //25
            ["name" => "Business Creation", 'faculty_id' => '4',], //26
            ["name" => "Internal Business Management", 'faculty_id' => '4',], //27
            ["name" => "Digital Business", 'faculty_id' => '4',], //28
            ["name" => "Entrepreneurship Business Creation", 'faculty_id' => '4',], //29
            ["name" => "Creativepreneurship", 'faculty_id' => '4',], //30

            ["name" => "Accounting", 'faculty_id' => '5',], //31
            ["name" => "Accounting Global Class", 'faculty_id' => '5',], //32
            ["name" => "Finance", 'faculty_id' => '5',], //33

            ["name" => "English Literature", 'faculty_id' => '6',], //34
            ["name" => "Japanese Literature", 'faculty_id' => '6',], //35
            ["name" => "Chinese Literature", 'faculty_id' => '6',], //36
            ["name" => "International Relation", 'faculty_id' => '6',], //37
            ["name" => "International Relation Global Class", 'faculty_id' => '6',], //38
            ["name" => "Psychology", 'faculty_id' => '6',], //39
            ["name" => "Business Law", 'faculty_id' => '6',], //40
            ["name" => "Primary Teacher Education", 'faculty_id' => '6',], //41

            ["name" => "Industrial Engineering", 'faculty_id' => '7',], //42
            ["name" => "Civil Engineering", 'faculty_id' => '7',], //43
            ["name" => "Computer Engineering", 'faculty_id' => '7',], //44
            ["name" => "Architecture", 'faculty_id' => '7',], //45
            ["name" => "Food Technology", 'faculty_id' => '7',], //46
            ["name" => "Professional Engineer Program", 'faculty_id' => '7',], //47
            ["name" => "Biotechnology", 'faculty_id' => '7',], //48
            ["name" => "Information System and Industrial Engineering", 'faculty_id' => '7',], //49

            ["name" => "Tourism", 'faculty_id' => '8',], //50
            ["name" => "Hotel Management", 'faculty_id' => '8',], //51
            ["name" => "Mass Communication", 'faculty_id' => '8',], //52
            ["name" => "Marketing Communication", 'faculty_id' => '8',], //53
            ["name" => "Business Hotel Management", 'faculty_id' => '8',], //54
            ["name" => "Creative Communication", 'faculty_id' => '8',], //55
            ["name" => "Communication", 'faculty_id' => '8',], //56
            ["name" => "Public Relations", 'faculty_id' => '8',], //57

            ["name" => "Product Design Engineering", 'faculty_id' => '9',], //58
            ["name" => "Automotive and Robotics Engineering", 'faculty_id' => '9',], //59
            ["name" => "Business Engineering", 'faculty_id' => '9',], //60

            ["name" => "Master of Computer Science", 'faculty_id' => '10',], //61
            ["name" => "Master of Communication Science", 'faculty_id' => '10',], //62
            ["name" => "Master of Information System Management", 'faculty_id' => '10',], //63
            ["name" => "Master of Industrial Engineering", 'faculty_id' => '10',], //64
            ["name" => "Doctor of Computer Science", 'faculty_id' => '10',], //65
        ];
        DB::table("majors")->insert($data);
    }
}
