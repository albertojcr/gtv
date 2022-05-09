<?php

namespace Database\Seeders;

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
        $this->call(ThematicAreaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PlaceSeeder::class);
        $this->call(PointOfInterestSeeder::class);
        $this->call(PhotographySeeder::class);
        $this->call(VisitSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(VideoItemSeeder::class);
    }
}
