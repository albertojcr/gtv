<?php

namespace Database\Seeders;

use App\Models\ThematicArea;
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
        factory(ThematicArea::class,10)->create();
    }
}
