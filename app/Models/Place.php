<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['date_create', 'last_update'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function userCreator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function userUpdater()
    {
        return $this->belongsTo(User::class, 'updater');
    }

    public function points_of_interest()
    {
        return $this->hasMany(PointOfInterest::class);
    }

    public static function create(array $attributes = [])
    {
        $attributes['creator'] = auth()->user()->id;
        $attributes['date_create'] = Carbon::now();

        $place = static::query()->create($attributes);

        return $place;
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($place){
            $place->users()->attach($place->creator);
        });

        static::updating(function($place) {
            $place->last_update = Carbon::now();
            $place->syncusers($place->updater);
        });

        static::deleting(function($place) {
            $place->users()->detach();
            $place->points_of_interest()->each(function($p) {
                $p->place_id = null;
                $p->save();
            });
        });
    }

    public function syncusers($user)
    {
        if($this->existsPlaceUserId($user)) {
            return $this->users()->sync($user);
        }
        return $this->users()->attach($user);
    }

    public function existsPlaceUserId($id)
    {
        return $this->users()->where('place_id', '=', $this->id)->where('user_id', '=', $id)->exists();
    }

    public function scopeAllowed($query)
    {
        if(auth()->user()->can('view', $this)) {
            return $query;
        }else{
            if (auth()->user()->hasRole('Profesor')){
                return $query->where('creator', auth()->id())->orWhere('updater', auth()->id());
            }
            abort(403);
        }
    }
}
