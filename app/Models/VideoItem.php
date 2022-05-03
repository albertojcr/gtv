<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class VideoItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['video_id', 'url', 'quality', 'format', 'orientation', 'language'];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($videoItem){
            $videoItem->video_id = $videoItem->video->id;
        });
    }

    public static function create(array $attributes = [])
    {
        $videoItem = static::query()->create($attributes);

        $videoItem->generateSlug();

        return $videoItem;
    }

    public function generateSlug()
    {
        $url = Str::slug($this->video->name);

        if(static::whereUrl($url)->exists()) {
            $url .= '--' . static::where('url', 'like', $url . '-%')->count();
        }

        $this->url = $url;
        $this->save();
    }

    public function getRouteKeyName()
    {
        return 'url';
    }
}
