@foreach($roles as $role)
    <div class="form-check mt-3">
        @if($role->name != "Super Administrador")
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                {{ $role->name }}
                <span class="form-check-sign"></span>
                {{ $role->permissions->pluck('name')->implode(', ') }}
            </label>
        @endif
    </div>
@endforeach


