<?php

namespace App\Policies;

use App\Models\PointOfInterest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PointOfInterestPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        return $user->hasRole('Administrador') || $user->hasRole('Super Administrador') ? true : null;
    }

    /**
     * Determine whether the user can view the point of interest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PointOfInterest  $pointOfInterest
     * @return mixed
     */
    public function view(User $user, PointOfInterest $pointOfInterest)
    {
        return $user->id === $pointOfInterest->creator || $user->id === $pointOfInterest->updater || $user->hasPermissionTo('Ver puntos de interes');
    }

    /**
     * Determine whether the user can create point of interests.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Crear puntos de interes');

    }

    /**
     * Determine whether the user can update the point of interest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PointOfInterest  $pointOfInterest
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasPermissionTo('Editar puntos de interes');
    }

    /**
     * Determine whether the user can delete the point of interest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PointOfInterest  $pointOfInterest
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissionTo('Borrar puntos de interes');
    }
}
