<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThematicArea extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function pointsOfInterest(){
        return $this->belongsToMany(PointOfInterest::class)->withPivot('thematic_area_id', 'title', 'description', 'language');
    }

    public function photographies()
    {
        return $this->hasMany(Photography::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($thematicarea) {
            $thematicarea->pointsOfInterest()->detach();
            $thematicarea->users()->each(function ($u){
                $u->thematic_area_id = null;
                $u->save();
            });

            $thematicarea->photographies()->each(function ($p){
                $p->thematic_area_id = null;
                $p->save();
            });

            $thematicarea->videos()->each(function ($v){
                $v->thematic_area_id = null;
                $v->save();
            });
        });
    }

    public static function create(array $attributes = [])
    {
        $thematic_area = static::query()->create($attributes);

        return $thematic_area;
    }

    public function scopeAllowed($query)
    {
        if(auth()->user()->can('view', $this)) {
            return $query;
        }
    }
}
