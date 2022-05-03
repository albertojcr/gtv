<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('videos');

        factory(Video::class,10)->create();
/*        $videos->each(function($v) {
            $v->url = Str::slug($v->name);
            $v->save();
        });*/
    }
}
