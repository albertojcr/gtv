<?php

namespace Database\Seeders;

use App\Models\PointOfInterest;
use App\Models\ThematicArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PointOfInterestsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $pointsOfInterest = factory(PointOfInterest::class, 20)->make();
        $pointsOfInterest->each(function($pointOfInterest) {
            $faker = \Faker\Factory::create();
            $pointOfInterest->save();
            $thematicAreas= ThematicArea::all()->pluck('id')->toArray();
            $pointOfInterest->thematicAreas()->attach(Arr::random($thematicAreas, 2),
                [
                    'title' => $faker->sentence,
                    'description' => $faker->text,
                ]);
        });
    }
}
