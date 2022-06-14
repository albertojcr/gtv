<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use hasRoles, HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'profile_photo_url',
    ];

    public function places()
    {
        return $this->hasMany(Place::class, 'creator');
    }

    public function photographies()
    {
        return $this->hasMany(Photography::class, 'creator');
    }

    public function pointsOfInterest()
    {
        return $this->hasMany(PointOfInterest::class, 'creator');
    }

    public function thematicAreas()
    {
        return $this->belongsToMany(ThematicArea::class)->withPivot(['date', 'active']);
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'creator');
    }
}
