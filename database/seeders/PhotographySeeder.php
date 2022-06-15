<?php

namespace Database\Seeders;

use App\Models\Photography;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PhotographySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('photos');
        Storage::disk('public')->makeDirectory('photos');

        factory(Photography::class, 30)->create();
    }
}
