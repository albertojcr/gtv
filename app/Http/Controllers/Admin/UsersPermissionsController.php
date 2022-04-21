<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersPermissionsController extends Controller
{
    public function update(Request $request, User $user)
    {
        $user->permissions()->detach();
        $user->givePermissionTo($request->permissions);
        return back()->with('flash', 'Los permisos han sido actualizados');
    }
}
