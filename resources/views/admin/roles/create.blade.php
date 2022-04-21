@extends('admin.layouts.app')

@section('title', 'Guia | Roles | Nuevo')

@section('header')
    Crear rol
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title">Nuevo Rol</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group has-label">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   placeholder="Escribe el nombre de un rol" value="{{ old('name') }}">
                            {!! $errors->first('name','<span class="form-text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group has-label">
                            <label for="display_name">Nombre como:</label>
                            <input type="text" name="display_name" class="form-control {{ $errors->has('display_name') ? 'is-invalid' : '' }}"
                                   value="{{ old('display_name') }}">
                            {!! $errors->first('display_name','<span class="form-text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group has-label">
                            <label for="guard_name">Nombre API:</label>
                            <select name="guard_name" class="form-control">
                                @foreach(config('auth.guards') as $guardName => $guardOptions)
                                    <option value="{{ $guardName }}" {{ old('guard_name') === $guardName ? 'selected' : '' }}>{{ $guardName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group has-label">
                            <label for="permissions">Permisos:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach($permissions as $id => $name)
                                        <div class="form-check">Permiso:
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $id }}" {{ collect(old('permissions'))->contains($id) ? 'checked' : '' }}>
                                                <span class="form-check-sign"></span>
                                                {{ $name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-check text-center">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

