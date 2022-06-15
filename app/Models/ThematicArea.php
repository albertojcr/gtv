<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThematicArea extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pointsOfInterest(){
        return $this->belongsToMany(PointOfInterest::class)->withPivot('thematic_area_id', 'title', 'description');
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
        return $this->belongsToMany(User::class)->withPivot(['date', 'active']);
    }
}
