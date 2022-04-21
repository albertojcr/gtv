@extends('admin.layouts.app')

@section('title', 'Guia | Roles | Editar')

@section('header')
    Editar Rol
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title">Editar Rol</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group has-label">
                            <label for="display_name">Nombre:</label>
                            <input type="text" name="display_name" class="form-control" value="{{ $role->name }}" disabled>
                            {!! $errors->first('display_name','<span class="form-text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group has-label">
                            <label for="display_name">Nombre como:</label>
                            <input type="text" name="display_name" class="form-control {{ $errors->has('display_name') ? 'is-invalid' : '' }}"
                                   value="{{ old('display_name', $role->display_name) }}">
                            {!! $errors->first('display_name','<span class="form-text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group has-label">
                            <label for="guard_name">Nombre API:</label>
                            <select name="guard_name" class="form-control">
                                @foreach(config('auth.guards') as $guardName => $guardOptions)
                                    <option value="{{ $guardName }}" {{ $role->$guardName === $guardName ? 'selected' : '' }}>{{ $guardName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group has-label">
                            <label for="permissions">Permisos:</label>
                            <div class="row">
                                <div class="col-md-12">
                                    @include('admin.permissions.checkboxes', ['model' => $role])
                                </div>
                            </div>
                        </div>
                        <div class="form-check text-center">
                            <button type="submit" class="btn btn-primary">Actulizar Rol</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
