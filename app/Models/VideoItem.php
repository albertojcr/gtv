<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

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

        return $videoItem;
    }
}
