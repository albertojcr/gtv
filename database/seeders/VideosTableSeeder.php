<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\VideoItem;
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

        factory(Video::class,10)->create()->each(function (Video $video) {
            factory(VideoItem::class)->create([
                'video_id' => $video->id,
            ]);
        });
    }
}
