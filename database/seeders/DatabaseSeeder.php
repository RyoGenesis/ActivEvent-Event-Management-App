<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CampusSeeder::class,
            FacultySeeder::class,
            MajorSeeder::class,
            CommunitySeeder::class,
            BgaSeeder::class,
            SatLevelSeeder::class,
            CommunityMajorSeeder::class,
            // UserSeeder::class,
        ]);
    }
}
