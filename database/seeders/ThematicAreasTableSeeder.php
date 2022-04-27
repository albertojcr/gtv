<?php

namespace Database\Seeders;

use App\ThematicArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ThematicAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $thematic_areas = factory(ThematicArea::class,10)->make();
        $thematic_areas->each(function($v) {
            $v->url = Str::slug($v->name);
            $v->save();
        });
    }
}
