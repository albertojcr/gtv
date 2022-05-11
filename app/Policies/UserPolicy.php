<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($authUser)
    {
        return $authUser->hasRole('Administrador') || $authUser->hasRole('Super Administrador') ? true : null;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $authUser, User $user)
    {
        return $authUser->id === $user->id || $authUser->hasPermissionTo('Ver usuarios');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $authUser)
    {
        return $authUser->hasPermissionTo('Crear usuarios');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $authUser, User $user)
    {
        return $authUser->id === $user->id || $authUser->hasPermissionTo('Editar usuarios');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissionTo('Borrar usuarios');
    }
}
