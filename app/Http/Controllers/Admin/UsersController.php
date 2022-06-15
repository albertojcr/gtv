<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminInformed;
use App\Events\UserWasRegisted;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\Photography;
use App\Models\ThematicArea;
use App\Models\User;
use App\Models\Video;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::allowed()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $user = new User;
        $this->authorize('create', $user);
        $thematic_areas = ThematicArea::all();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');
        return view('admin.users.create', compact('thematic_areas', 'roles', 'permissions', 'user'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new User);
        $data = $this->validate($request, [
            'login' => 'required | unique:users',
            'email' => 'required | string | unique:users',
        ], [
            'login.required' => 'El nombre de usuario es requerido',
            'login.unique' => 'El nombre de usuario ya existe en nuestros registros',
            'email.required' => 'El correo electronico es requerido',
            'email.string' => 'El correo no es valido',
            'email.email' => 'El correo no es valido',
            'email.unique' => 'El correo electronico ya existe en nuestros registros',
        ]);

        $data['password'] = Str::random(8);

        $user = User::create($data);

        $user->assignRole($request->roles);

        $user->givePermissionTo($request->permissions);

        $admins = $this->getAdmins();

        UserWasRegisted::dispatch($user, $data['password']);

        AdminInformed::dispatch($admins, $user);

        return redirect()->route('admin.users.index')->with('flash', 'El usuario ha sido creado correctamente');
    }

    private function getAdmins()
    {
        $role = Role::findByName('Administrador');
        $admins = $role->users()->pluck('email');
        return $admins;
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        $hashids = new Hashids('secret',7);
        $idEncript=$hashids->encode($user->id);

        return view('admin.users.show', compact('user','idEncript'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $thematic_areas = ThematicArea::all();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');
        $hashids = new Hashids('secret',7);
        $idEncript=$hashids->encode($user->id);

        return view('admin.users.edit', compact('user', 'thematic_areas', 'permissions', 'roles','idEncript'));
    }

    public function update(User $user, UpdateUsersRequest $request)
    {
        $this->authorize('update', $user);
        $request->get('active')== '1' ? $request->active = 1 : $request->active = 0;

        $user->update($request->validated());

        if(auth()->user()->roles->first()->name == "Alumno" || auth()->user()->roles->first()->name == "Profesor") {
            return back()->with('flash', 'Tus datos han sido actualizados correctamente');
        }

        return redirect()
            ->route('admin.users.index', $user)
            ->with('flash', 'El usuario ' . $user->login . ' ha sido actualizado correctamente');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        if ($user->hasRole('Super Administrador')) {
            return back()->with('danger', 'El usuario ' . $user->login . ' no ha podido ser eliminado, ya que no tiene permisos para ello');
        }

        if(auth()->user()->roles->first()->name == "Administrador") {
            if ($user->hasRole('Administrador')) {
                return back()->with('danger', 'El usuario ' . $user->login . ' no ha podido ser eliminado, ya que tiene el rol Administrador');
            }
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('flash', 'El usuario ' . $user->login . ' ha sido eliminado correctamente');
    }
    public function processPhoto($data)
    {
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $result[0] = base64_decode($data);
        $result[1] = time() . '.png';
        return $result;
    }

    public function updatePhoto(Request $request)
    {
        $hashids = new Hashids('secret',7);
        $id=$hashids->decode($request->get('user'));
        $user = User::find((int)$id[0]);
        $this->authorize('update', $user);
        $data = $request->get('profile');
        $data=$this->processPhoto($data);

        file_put_contents(public_path()."/storage/users/" . $data[1] , $data[0]);

        $user->update([
            'profile' => "users/" . $data[1]
        ]);

        return response()->json(['success' => 'success']);
    }

    public function countStatisticsUsers()
    {
        $photographies = Photography::get()->Auth::user();
        $videos = Video::get()->Auth::user();

        return view('admin.dashboard', compact(['photographies', 'videos']));
    }

    public function manage(Request $request)
    {
        $request->user()->authorizeRoles('Super Administrador');

        $authSuperAdmin = Auth::user()->hasRole('Super Administrador');
        $users = User::all();
        $users->reject($authSuperAdmin);

        return view('admin.roles.checkboxes')->with('users', $users);
    }
}
