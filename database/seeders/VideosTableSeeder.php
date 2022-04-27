<?php

namespace Database\Seeders;

use App\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        $video = factory(Video::class,10)->make();
        $video->each(function($v) {
            $v->url = Str::slug($v->name);
            $v->save();
        });
    }
}
