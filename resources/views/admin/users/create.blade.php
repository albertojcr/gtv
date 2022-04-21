@extends('admin.layouts.app')

@section('title', 'Guia | Usuarios | Nuevo')

@section('header')
    Crear Usuario
@endsection

@section('content')
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title">Nuevo Usuario</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group has-label">
                            <label for="login">Nombre de usuario:</label>
                            <input type="text" name="login" class="form-control {{ $errors->has('login') ? 'is-invalid' : '' }}"
                                   placeholder="Escribe un nombre de usuario" value="{{ old('login') }}">
                            {!! $errors->first('login','<span class="form-text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group has-label">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   placeholder="Escribe un nombre" value="{{ old('name') }}">
                            {!! $errors->first('name','<span class="form-text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group has-label">
                            <label for="surnames">Apellidos:</label>
                            <input type="text" name="surnames" class="form-control {{ $errors->has('surnames') ? 'is-invalid' : '' }}"
                                   placeholder="Escribe unos apellidos" value="{{ old('surnames') }}">
                            {!! $errors->first('surnames','<span class="form-text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group has-label">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   placeholder="Escribe su correo electrónico" value="{{ old('email') }}">
                            {!! $errors->first('email','<span class="form-text text-danger">:message</span>') !!}
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title">Roles</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.roles.checkboxes')
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title">Permisos</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.permissions.checkboxes', ['model' => $user])
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
