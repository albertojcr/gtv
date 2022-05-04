<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['date_create', 'last_update'];

    public function video_items()
    {
        return $this->hasMany(VideoItem::class);
    }

    public function userCreator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function userUpdater()
    {
        return $this->belongsTo(User::class, 'updater');
    }

    public function pointOfInterest()
    {
        return $this->belongsTo(PointOfInterest::class);
    }

    public function thematic_area()
    {
        return $this->belongsTo(ThematicArea::class);
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function($video) {
            if(Request::has('route')) {
                $file_name = $video->url . '.mp4';
                $video->route = Request::file('route')->storeAs('public/videos', $file_name);
            }
            $video->updater = auth()->user()->id;
            $video->last_update = Carbon::now();
        });

        static::deleting(function($video){
            Storage::disk('public')->delete($video->route);
            $video->video_items()->delete();
        });
    }

    public static function create(array $attributes = [])
    {
        $attributes['creator'] = auth()->user()->id;
        $attributes['date_create'] = Carbon::now();

        $video = static::query()->create($attributes);

        $video->generateSlug();

        return $video;
    }

    public function generateSlug()
    {
        $url = Str::slug($this->description);

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
    public static function countNewVideos()
    {
        return (int)count(Video::whereDate('created_at', Carbon::today())->get());
    }

    public function scopeAllowed($query)
    {
        if(auth()->user()->can('view', $this)) {
            if (auth()->user()->hasRole('Profesor')){
                return $query->where('thematic_area_id', auth()->user()->thematic_area_id);
            }
            return $query;
        }else{
            return $query->where('creator', auth()->id())->orWhere('updater', auth()->id());
        }
    }
}
