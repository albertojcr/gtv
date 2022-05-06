<?php

namespace Database\Seeders;

use App\Models\Photography;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotographiesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('photos');

        $photography = factory(Photography::class, 30)->create();
    }
}
