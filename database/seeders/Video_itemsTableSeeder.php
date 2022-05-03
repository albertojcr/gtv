<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\VideoItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Video_itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $video_items = factory(VideoItem::class, 30)->make();

        $video_items->each(function($video_item) {
            $video_item->url = Str::slug($video_item->video->description);
            $video_item->save();
        });
    }
}
