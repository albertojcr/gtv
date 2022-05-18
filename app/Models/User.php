<?php

namespace App\Models;

use App\Notifications\MyResetPassword;
use Carbon\Carbon;
use DateTime;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, hasRoles, SoftDeletes, HasFactory;

    protected $fillable = [
        'login', 'name', 'surnames', 'email', 'password', 'profile', 'thematic_area_id', 'active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function places()
    {
        return $this->belongsToMany(Place::class);
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

    public static function create(array $attributes = [])
    {
        $user = static::query()->create($attributes);
        return $user;
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function ($user) {
            Request::has('thematic_area_id') ? $user->thematic_area_id : null;
        });

        static::deleting(function ($user) {
            Storage::disk('public')->delete($user->profile);
            $user->roles()->detach();
            $user->permissions()->detach();
            $user->places()->detach();
        });
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function scopeAllowed($query)
    {
        if (auth()->user()->can('view', $this)) {
            return $query;
        } else {
            return $query->where('id', auth()->id());
        }
    }

    public static function registerLastLogin(Login $event)
    {
        $event->user->last_login = new DateTime();
        $event->user->save();
    }

    public static function inactiveUsers()
    {
        $date = Carbon::now();
        return User::query()->where([
            ['last_login', '<', $date->subMonth(3)],
            ['active', '=', true]
        ]);
    }
    public static function countNewUsers()
    {
       return  (int)count(User::whereDate('created_at', Carbon::today())->get());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }
}

