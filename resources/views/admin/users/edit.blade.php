@extends('admin.layouts.app')
@section('title', 'Guia | Usuarios | Editar')

@section('header')
    Editar Usuario
@endsection

@if (Auth::user()->id ==$user->id || Auth::user()->hasRole('Administrador') )
    @include('admin.users.photo')
@endif
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <form action="{{route('admin.users.update',$user)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title">Modificar Usuario: {{ $user->login }}</h4>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="modal-body">
                                    <div class="text-center">
                                        <label for="profile">Foto de perfil</label>
                                        <div class="profile-photo form-group has-label">
                                            <div class="mb-2">
                                                <a href="#" data-toggle="modal" data-target="#editPhoto">
                                                    <img class="photo"
                                                         src="{{ $user->profile ? Storage::url($user->profile) : '/admin/img/default-avatar.png' }}">
                                                </a>
                                            </div>
                                        </div>
                                        {!! $errors->first('profile', '<span class="form-text text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group has-label">
                                    <label for="email">Correo electrónico:</label>
                                    <input type="email" name="email"
                                           class="form-control"
                                           value="{{ old('email', $user->email) }}" disabled>
                                </div>

                                <div class="form-group has-label">
                                    <label for="login">Nombre usuario:</label>
                                    <input type="text" name="login"
                                           class="form-control {{ $errors->has('login') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el nombre del usuario"
                                           value="{{ old('login', $user->login) }}">
                                    {!! $errors->first('login','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="name">Nombre:</label>
                                    <input type="text" name="name"
                                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe un nombre" value="{{ old('name', $user->name) }}">
                                    {!! $errors->first('name','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="surnames">Apellidos:</label>
                                    <input type="text" name="surnames"
                                           class="form-control {{ $errors->has('surnames') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe unos apellidos"
                                           value="{{ old('surnames', $user->surnames) }}">
                                    {!! $errors->first('surnames','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password"
                                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe una contraseña">
                                    {!! $errors->first('password','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="passwordConfirm">Confirma contraseña</label>
                                    <input type="password" name="password_confirmation"
                                           class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe de nuevo la contraseña">
                                    {!! $errors->first('password_confirmation','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="thematic_area_id">Área temáticas</label>
                                    <select name="thematic_area_id"
                                            class="form-control selectpicker" data-style="btn btn-info btn-round">
                                        <option value="">Selecciona una área temática</option>
                                        @foreach($thematic_areas as $thematic_area)
                                            <option
                                                value="{{ $thematic_area->id }}" {{ old('thematic_area_id', $user->thematic_area_id) == $thematic_area->id ? 'selected' : ''}}>{{ $thematic_area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if(auth()->user()->id != $user->id)
                                    @role('Administrador')
                                    <div class=" checkbox-radios">
                                        <label for="active">Estado del usuario</label>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="active" value="1" {{ $user->active == '1' ? 'checked' : '' }}>
                                                <span class="form-check-sign"></span>
                                                Activo
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="active" value="0" {{ $user->active == '0' ? 'checked' : '' }}>
                                                <span class="form-check-sign"></span>
                                                Inactivo
                                            </label>
                                        </div>
                                    </div>
                                    @endrole
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Roles</h3>
                </div>
                <div class="card-body">
                    @role('Administrador')
                    <form action="{{ route('admin.users.roles.update', $user) }}" method="post">
                        @csrf
                        @method('put')
                        @include('admin.roles.checkboxes')
                        <div class="text-center">
                            <button class="btn btn-primary justify-content-center">Actualizar Roles</button>
                        </div>
                    </form>
                    @else
                        <ul class="list-group">
                            @forelse($user->roles as $role)
                                <li class="list-group-item">{{ $role->name }}</li>
                            @empty
                                <li class="list-group-item">No tienes roles asignados</li>
                            @endforelse
                        </ul>
                    @endrole
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Permisos</h3>
                </div>
                <div class="card-body">
                    @role('Administrador')
                    <form action="{{ route('admin.users.permissions.update', $user) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="text-center">
                            @include('admin.permissions.checkboxes', ['model' => $user])
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Actualizar Permisos</button>
                        </div>
                    </form>
                    @else
                        <ul class="list-group">
                            @forelse($user->permissions as $permission)
                                <li class="list-group-item">{{ $permission->name }}</li>
                            @empty
                                <li class="list-group-item">No tienes permisos asignados</li>
                            @endforelse
                        </ul>
                        @endrole
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/admin/js/croppie.js"></script>
    <script src="/admin/js/plugins/bootstrap-selectpicker.js"></script>
@endpush
