<?php

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
        $this->call(ThematicAreasTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(PointOfInterestsTableSeeder::class);
        $this->call(PhotographiesTableSeeder::class);
        $this->call(VisitsTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(Video_itemsTableSeeder::class);
    }
}
