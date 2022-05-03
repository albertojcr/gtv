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
        $pointsInterest = factory(PointOfInterest::class, 20)->make();
        $pointsInterest->each(function($p) {
            $faker = \Faker\Factory::create();
            $p->url = Str::slug($p->qr);
            $p->save();
            $thematicAreas= ThematicArea::all()->pluck('id')->toArray();
            $p->thematicAreas()->attach(Arr::random($thematicAreas, 2),
                [
                    'title' =>  $faker->sentence,
                    'description'   =>  $faker->text,
                    'language'  =>$faker->languageCode
                ]);
        });

    }
}
