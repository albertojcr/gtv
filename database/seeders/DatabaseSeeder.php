<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('videos');
        Storage::disk('public')->makeDirectory('videos');

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
