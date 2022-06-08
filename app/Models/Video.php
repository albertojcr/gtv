<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function videoItems()
    {
        return $this->hasMany(VideoItem::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updater');
    }

    public function pointOfInterest()
    {
        return $this->belongsTo(PointOfInterest::class);
    }

    public function thematicArea()
    {
        return $this->belongsTo(ThematicArea::class);
    }
}
