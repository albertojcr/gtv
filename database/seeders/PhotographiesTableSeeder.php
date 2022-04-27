<?php

namespace Database\Seeders;

use App\Photography;
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

        $photography = factory(Photography::class, 30)->make();
        $photography->each(function($p) {
            $p->url = Str::slug($p->name);
            $p->save();
        });
    }
}
