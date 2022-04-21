@extends('admin.layouts.app')

@section('title', 'Guia | Perfil')

@section('header')
    Tu Perfil
@endsection

@if (Auth::user()->id ==$user->id || Auth::user()->hasRole('Administrador') )
    @include('admin.users.photo')
@endif

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-user">
                <div class="card-body">
                    <div class="author">
                        <a href="#" data-toggle="modal" data-target="#editPhoto">
                            <img class="avatar border-gray" src="{{ $user->profile ? Storage::url($user->profile) : '/admin/img/default-avatar.png'  }}">
                        </a>
                        <h5 class="title">{{ $user->login }} </h5>
                    </div>
                    <p class="description text-center">
                        {{ $user->roles->first()->name }}
                    </p>
                    <div class="text-center">
                        <p><span class="font-weight-bold">Nombre: <small>{{ $user->name }}</small></span></p>
                        <p><span class="font-weight-bold">Apellidos: <small>{{ $user->surnames }}</small></span></p>
                        <p><span class="font-weight-bold">Correo electrónico: <small>{{ $user->email }}</small></span></p>
                        <p><span class="font-weight-bold">Área temática: </span> <small>{{ $user->thematic_area ? $user->thematic_area->name : 'No está en ninguna rama temática' }}</small></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-user">
                <div class="card-header">
                    <h3 class="text-center">Roles</h3>
                </div>
                <div class="card-footer">
                    @forelse($user->roles as $role)
                        <ul class="list-group">
                            <li class="list-unstyled text-center">{{ $role->name }}</li>
                        </ul>
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <small class="text-muted">No tiene roles</small>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Permisos asignados</h3>
                </div>
                <div class="card-footer">
                    @forelse($user->permissions as $permission)
                        <ul class="list-group">
                            <li class="list-unstyled text-center">{{ $permission->name }}</li>
                        </ul>
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <div class="text-center">
                            <small class="text-muted">No tiene permisos adicionales</small>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        @role('Profesor')
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Lugares</h3>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        @forelse($user->places->slice(0,5) as $place)
                            <strong>{{ $place->name }}</strong>
                            <br>
                            <p class="text-muted">{{ $place->description }}</p>
                            @unless($loop->last)
                                <hr>
                            @endunless
                        @empty
                            <div class="text-center">
                                <small class="text-muted">No tiene ningun lugar publicado</small>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Puntos de interés</h3>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        @forelse($user->points_of_interest->slice(0,5) as $pointofinterest)
                            <div class="row">
                                <div class="col-md-6">
                                    <p><span class="font-weight-bold">Codigo qr: </span> <small>{{ $pointofinterest->qr }}</small></p>
                                    <p><span class="font-weight-bold">Distancia: </span> <small>{{ $pointofinterest->distance }}</small></p>
                                    <p><span class="font-weight-bold">Latitud: </span> <small>{{ $pointofinterest->latitude }}</small></p>
                                    <p><span class="font-weight-bold">Longitud: </span> <small>{{ $pointofinterest->longitude }}</small></p>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="font-weight-bold">Areas tematicas: </span> <small>{{ $pointofinterest->thematicAreas->pluck('name')->implode(',') }}</small></p>
                                    <p><span class="font-weight-bold">Nombre: </span> <small>{{ $pointofinterest->thematicAreas->pluck('pivot')->pluck('title')->first() }}</small></p>
                                    <p><span class="font-weight-bold">Descripcion: </span> <small>{{ $pointofinterest->thematicAreas->pluck('pivot')->pluck('description')->first() }}</small></p>
                                    <p><span class="font-weight-bold">Idioma: </span> <small>{{ $pointofinterest->thematicAreas->pluck('pivot')->pluck('language')->first() }}</small></p>
                                </div>
                            </div>
                            @unless($loop->last)
                                <hr>
                            @endunless
                        @empty
                            <div class="text-center">
                                <small class="text-muted">No tiene ningun punto de interés publicado</small>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @endrole
        @role('Alumno')
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Fotografias </h3>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        @forelse($user->photographies as $i => $photography)
                            @if($i%3 == 0)
                                <div class="row">
                                    @endif
                                    <div class="pb-4 col-md-4 col-sm-4 col-lg-4 text-center">
                                        <div class="card">
                                            <div class="card-img">
                                                <img src="{{ $photography->route ? Storage::url($photography->route) :'/admin/img/notAvailable.png' }}" alt="{{ $photography->name }}" width="200" class="rounded">
                                            </div>
                                            <div class="card-body">
                                                <div class="card-title">
                                                    <p>{{ $photography->order }}. {{ $photography->name }}</p>
                                                </div>
                                                <div class="text-center">
                                                    <a href="{{ route('admin.photographies.show', $photography->url) }}" class="btn btn-primary">Ver detalles</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($i%3 == 2)
                                </div>
                            @endif
                        @empty
                            <div class="text-center">
                                <small class="text-muted">No tiene ninguna publicación</small>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Videos</h3>
                </div>
                <div class="card-body">
                    @forelse($user->videos as $i => $video)
                        @if($i%3 == 0)
                            <div class="row">
                                @endif
                                <div class="col-md-4 col-sm-4 col-lg-4 text-center">
                                    <div class="card">
                                        <div class="card-img">
                                            <video width="370" height="280" {{ $video->route ? 'controls' : '' }}>
                                                <source src="{{ Storage::url($video->route) }}" alt="{{ $video->name }}" type="video/mp4">
                                            </video>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <p>{{ $video->order }}. {{ $video->name }}</p>
                                            </div>
                                            <div class="text-center">
                                                <a href="{{ route('admin.videos.show', $video->url) }}" class="btn btn-primary">Ver detalles</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($i%3 == 2)
                            </div>
                        @endif
                    @empty
                        <div class="text-center">
                            <small class="text-muted">No tiene ninguna publicación</small>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        @endrole
    </div>
@endsection

@push('scripts')
    <script src="/admin/js/croppie.js" ></script>
@endpush
