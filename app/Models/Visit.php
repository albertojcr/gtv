<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Visit extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['hour'];

    public static function create(array $attributes = [])
    {
        $visit = static::query()->create($attributes);

        return $visit;
    }

    public function point_of_interest()
    {
        return $this->belongsTo(PointOfInterest::class);
    }

    public function setHourAttribute($hour)
    {
        $this->attributes['hour'] = $hour ? Carbon::parse($hour)->format('Y-m-d H:i:s') : null;
    }

    public static function DatesForGrafic()
    {
        return Visit::query()->whereDate('created_at','>=', Carbon::now()->subDays(7))->get()
            ->groupBy(
                function($date) {
                    return Carbon::parse($date->created_at)->format('d-m-Y' );
                });
    }

    public static function getPointsOfInterestMostVisit(){
        return Visit::query()->get()->groupBy('point_of_interest_id')->take(5)->sort();
    }
}
