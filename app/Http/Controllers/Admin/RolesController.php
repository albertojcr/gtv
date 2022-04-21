<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('create', new Role);
        $permissions = Permission::pluck('name', 'id');
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Role);

        $this->validate($request, [
            'name' => 'required | unique:roles',
            'guard_name' => 'required',
            'display_name' => 'required'
        ], [
            'name.required' => 'El nombre del rol es requerido',
            'name.unique' => 'El nombre del rol no puede ser repetido',
            'guard_name.required' => 'El nombre API es requerido',
            'display_name.required' => 'El nombre alias de rol es requerido'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
            'display_name' => $request->display_name
        ]);

        if($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.roles.index')->with('flash', 'El rol ha sido creado correctamente');
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        $permissions = Permission::pluck('name', 'id');
        return view('admin.roles.edit', compact('permissions','role'));
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $this->validate($request, [
            'display_name' => 'required',
            'guard_name' => 'required'
        ], [
            'guard_name.required' => 'El nombre API es requerido',
            'display_name.required' => 'El nombre alias de rol es requerido'
        ]);

        $role->update([
            'guard_name' => $request->guard_name,
            'display_name' => $request->display_name
        ]);

        $role->permissions()->detach();

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return back()->with('flash', 'El rol ' . $role->name . ' ha sido actualizado');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        return redirect()->route('admin.roles.index')->withFlash('El rol '. $role->name . ' ha sido eliminado');
    }
}
