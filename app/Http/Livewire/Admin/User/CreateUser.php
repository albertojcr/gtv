<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class CreateUser extends Component
{
    use WithFileUploads;

    public $roles, $avatarTemporaryUrl;

    protected $listeners = ['openCreationModal'];

    public $createForm = [
        'open' => false,
        'avatar' => null,
        'name' => '',
        'email' => '',
        'password' => '',
        'role' => '',
    ];

    protected $rules = [
        'createForm.avatar' => 'image',
        'createForm.name' => 'required|string',
        'createForm.email' => 'required|confirmed|string|max:45|unique:users,email',
        'createForm.password' => 'required|confirmed|string|min:8|max:500',
        'createForm.role' => 'required|exists:roles,id',
    ];

    protected $validationAttributes = [
        'createForm.avatar' => 'avatar',
        'createForm.name' => 'nombre',
        'createForm.email' => 'email',
        'createForm.password' => 'contraseña',
        'createForm.role' => 'rol',
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function openCreationModal()
    {
        $this->createForm['open'] = true;
    }

    public function updatedCreateFormAvatar()
    {
        $this->avatarTemporaryUrl = $this->createForm['avatar']->temporaryUrl();
    }

    public function save()
    {
        $this->validate();

        $avatarRoute = $this->createForm['avatar']->store('public/user-avatars');

        $user = User::create([
            'name' => $this->createForm['name'],
            'email' => $this->createForm['email'],
            'password'=> \bcrypt($this->createForm['password']),
            'profile_photo_path' => $avatarRoute,
        ]);

        $role = Role::findById($this->createForm['role']);
        $user->assignRole($role);

        $this->reset('createForm');
        $this->emit('userCreated');
        $this->emitTo('admin.user.list-users', 'render');
    }

    public function render()
    {
        return view('livewire.admin.user.create-user');
    }
}
