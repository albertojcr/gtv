@extends('admin.layouts.app')

@section('title', 'Guia | Puntos de Interés | Ver')

@section('header')
    Ver Punto de Interés
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header">
                    <h4 class="card-title text-center">Punto de interés: {{ $pointsofinterest->place ? $pointsofinterest->place->name : $pointsofinterest->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <span class="font-weight-bold">Escanea el codigo qr a mostrar el punto de interés desde tu movil</span>
                                {!!QrCode::size(300)->generate( 'https://goo.gl/maps/' . $pointsofinterest->qr ) !!}
                                <p><span class="font-weight-bold">Qr:</span> {{ $pointsofinterest->qr }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-left">
                                <p><span class="font-weight-bold">Distancia:</span> {{ $pointsofinterest->distance }}</p>
                                <p><span class="font-weight-bold">Latitud:</span> {{ $pointsofinterest->latitude }}</p>
                                <p><span class="font-weight-bold">longitud:</span> {{ $pointsofinterest->longitude }}</p>
                                <p><span class="font-weight-bold">Areas tematicas:</span> {{ $pointsofinterest->thematicAreas->pluck('name')->implode(',') }} </p>
                                <p><span class="font-weight-bold">Titulo:</span> {{ $pointsofinterest->thematicAreas->pluck('pivot')->pluck('title')->first() }} </p>
                                <p><span class="font-weight-bold">Descripción:</span> {{ $pointsofinterest->thematicAreas->pluck('pivot')->pluck('description')->first() }} </p>
                                <p><span class="font-weight-bold">Idioma:</span> {{ $pointsofinterest->thematicAreas->pluck('pivot')->pluck('language')->first() }} </p>
                                <p><span class="font-weight-bold">Creado por:</span> {{ $pointsofinterest->userCreator->login }} {{ $pointsofinterest->creation_date->diffForHumans() }}</p>
                                <p><span class="font-weight-bold">Editado por:</span> {{ $pointsofinterest->userUpdater->login }} {{ $pointsofinterest->last_update_date->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('admin.pointsofinterest.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection


