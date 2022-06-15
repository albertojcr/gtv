<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PointOfInterest extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['created_at','updated_at','creation_date', 'last_update_date'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updater');
    }

    public function thematicAreas()
    {
        return $this->belongsToMany(ThematicArea::class)->withPivot('point_of_interest_id', 'title', 'description');
    }

    public function photographies()
    {
        return $this->hasMany(Photography::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public static function create(array $attributes = [])
    {
        $attributes['creation_date']=Carbon::now();
        $attributes['creator']= auth()->user()->id;

        $pointOfInterest = static::query()->create($attributes);

        return $pointOfInterest;
    }

    public function syncthematicAreas($thematicAreas, $title, $description)
    {
        $this->thematicAreas()->detach();

        if(!$this->existThematicAreaId($thematicAreas)) {
            $this->thematicAreas()->attach($thematicAreas, [
                'title' => $title,
                'description' => $description,
            ]);
        }

        return $this->thematicAreas()->updateExistingPivot($thematicAreas, [
            'title' => $title,
            'description' => $description,
        ]);
    }

    public function existThematicAreaId($id)
    {
        return $this->thematicAreas()
            ->where('thematic_area_id', '=', $id)
            ->exists();
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function($pointsofinterest) {
            $pointsofinterest->last_update_date = Carbon::now();
            $pointsofinterest->updater = auth()->user()->id;
        });

        static::deleting(function($pointOfInterest){
            $pointOfInterest->thematicAreas()->detach();
            $pointOfInterest->photographies()->each(function($p) {
                $p->point_of_interest_id = null;
                $p->save();
            });

            $pointOfInterest->visits()->each(function($v) {
                $v->point_of_interest_id = null;
                $v->save();
            });

            $pointOfInterest->videos()->each(function($v) {
                $v->point_of_interest_id = null;
                $v->save();
            });
        });
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
    public static function countNewPointsOfInterest()
    {
        return (int)count(PointOfInterest::whereDate('creation_date', Carbon::today())->get());
    }

    public static function datesForGrafic(){
        return PointOfInterest::query()->where('deleted_at','=',null)->whereDate('creation_date','>=', Carbon::now()->subDays(7))->get()->groupBy(function($date) {
            return Carbon::parse($date->creation_date)->format('d-m-Y' );
        });
    }
}
