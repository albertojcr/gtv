<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThematicAreaPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        return $user->hasRole('Administrador') || $user->hasRole('Super Administrador') ? true : null;
    }

    public function view(User $user)
    {
        return $user->hasPermissionTo('Ver areas tematicas');
    }

    /**
     * Determine whether the user can create point of interests.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Crear areas tematicas');
    }

    /**
     * Determine whether the user can update the point of interest.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasPermissionTo('Editar areas tematicas');
    }

    /**
     * Determine whether the user can delete the point of interest.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissionTo('Borrar areas tematicas');
    }
}
