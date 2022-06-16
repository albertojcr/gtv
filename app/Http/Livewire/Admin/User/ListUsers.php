<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    public $listeners = ['delete', 'render'];

    public $detailsModal = [
        'open' => false,
        'avatar' => null,
        'id' => null,
        'name' => '',
        'email' => '',
        'password' => '',
        'emailVerifiedAt' => '',
        'createdAt' => '',
        'updatedAt' => '',
    ];

    public function show(User $user)
    {
        $this->reset(['detailsModal']);

        $this->detailsModal['open'] = true;
        if ($user->profile_photo_path) {
            $this->detailsModal['avatar'] = Storage::url($user->profile_photo_path);
        }
        $this->detailsModal['id'] = $user->id;
        $this->detailsModal['name'] = $user->name;
        $this->detailsModal['email'] = $user->email;
        $this->detailsModal['password'] = $user->password;
        $this->detailsModal['emailVerifiedAt'] = $user->email_verified_at;
        $this->detailsModal['createdAt'] = $user->created_at;
        $this->detailsModal['updatedAt'] = $user->updated_at;
    }

    public function delete(User $user)
    {
        if(Storage::exists($user->profile_photo_path)) {
            Storage::delete($user->profile_photo_path);
        }

        $user->delete();
    }

    public function render()
    {
        $users = User::where('email', '<>', auth()->user()->email)
            ->orderBy('id')
            ->paginate(10);

        return view('livewire.admin.user.list-users', compact('users'));
    }
}
