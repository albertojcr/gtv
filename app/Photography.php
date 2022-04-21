<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Photography extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'url', 'route', 'point_of_interest_id', 'order', 'published', 'date_create', 'last_update', 'creator', 'updater', 'thematic_area_id'];
    protected $dates = ['date_create', 'last_update'];

    public function point_of_interest()
    {
        return $this->belongsTo(PointOfInterest::class);
    }

    public function thematic_area()
    {
        return $this->belongsTo(ThematicArea::class);
    }

    public function userCreator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function userUpdater()
    {
        return $this->belongsTo(User::class, 'updater');
    }

    public static function create(array $attributes = [])
    {
        $attributes['creator'] = auth()->user()->id;
        $attributes['date_create'] = Carbon::now();
        $photography = static::query()->create($attributes);

        $photography->generateSlug();

        return $photography;
    }

    public function generateSlug()
    {
        $url = Str::slug($this->name);

        if(static::whereUrl($url)->exists()) {
            $url .= '--' . static::where('url', 'like', $url . '-%')->count();
        }

        $this->url = $url;
        $this->save();
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function($photography) {
            if(Request::has('route')) {
                $file_name = $photography->url . '.png';
                $photography->route = Request::file('route')->storeAs('public/photos', $file_name);
            }
            $photography->updater = auth()->user()->id;
            $photography->last_update = Carbon::now();
        });

        static::deleting(function($photography){
            Storage::disk('public')->delete($photography->route);
        });
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

    public static function countNewPhotos()
    {
        return (int)count(Photography::whereDate('created_at', Carbon::today())->get());
    }

    public function getRouteKeyName()
    {
        return 'url';
    }
}
