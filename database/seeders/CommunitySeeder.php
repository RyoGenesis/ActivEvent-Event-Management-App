<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "Binus University", "display_name" => "Binus University"], //1
            ["name" => "Himpunan Mahasiswa Teknik Informasi", "display_name" => "HIMTI"], //2
            ["name" => "Himpunan Mahasiswa Teknik Komputer", "display_name" => "HIMTEK"], //3
        ];
        DB::table("communities")->insert($data);
    }
}
