@extends('admin.layouts.app')

@section('title', 'Guia | Fotografias | Ver foto')

@section('header')
    Ver Foto
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header">
                    <h4 class="card-title text-center">Fotografia nº {{ $photography->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <img src="{{ $photography->route ? Storage::url($photography->route) : '/admin/img/notAvailable.png' }}" alt="{{ $photography->route }}" class="rounded img-raised w-50 h-50">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-left">
                                <p><span class="font-weight-bold">Nombre de la foto:</span> {{ $photography->name }}</p>
                                <p><span class="font-weight-bold">Orden:</span> {{ $photography->order }}</p>
                                <p><span class="font-weight-bold">Publicado:</span> {{ $photography->published == '1' ? 'Sí' : 'No' }}</p>
                                <p><span class="font-weight-bold">Punto de interés:</span> {{ $photography->point_of_interest ? $photography->point_of_interest->qr : '' }}</p>
                                <p><span class="font-weight-bold">Área temática:</span> {{ $photography->thematic_area ? $photography->thematic_area->name : '' }}</p>
                                <p><span class="font-weight-bold">Creado por:</span> {{ $photography->userCreator->login }} {{ $photography->date_create->diffForHumans() }}</p>
                                <p><span class="font-weight-bold">Editado por:</span> {{ $photography->userUpdater->login }} {{ $photography->last_update->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('admin.photographies.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection

