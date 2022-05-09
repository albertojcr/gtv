<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Photography' => 'App\Policies\PhotographyPolicy',
        'App\Models\Place' => 'App\Policies\PlacePolicy',
        'App\Models\PointOfInterest' => 'App\Policies\PointOfInterestPolicy',
        'App\Models\ThematicArea' => 'App\Policies\ThematicAreaPolicy',
        'App\Models\Video' => 'App\Policies\VideoPolicy',
        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
