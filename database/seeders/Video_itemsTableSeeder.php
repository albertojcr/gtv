<?php

namespace Database\Seeders;

use App\VideoItem;
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
        $video_item = factory(VideoItem::class, 30)->make();
        $video_item->each(function($v) {
            $v->url = Str::slug($v->video->name);
            $v->save();
        });
    }
}
