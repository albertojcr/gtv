@extends('admin.layouts.app')

@section('title', 'Guia | Videos | Ver')

@section('header')
    Ver Video
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header">
                    <h4 class="card-title text-center">Video nº {{ $video->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <video width="300" height="300" {{ $video->route ? 'controls' : '' }}>
                                    <source src="{{ Storage::url($video->route) }}" type="video/mp4">
                                </video>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-left">
                                <p><span class="font-weight-bold">Descripción del vídeo:</span> {{ $video->description }}</p>
                                <p><span class="font-weight-bold">Orden:</span> {{ $video->order }}</p>
                                <p><span class="font-weight-bold">Publicado:</span> {{ $video->published == '1' ? 'Sí' : 'No' }}</p>
                                <p><span class="font-weight-bold">Punto de interés:</span> {{ $video->pointOfInterest ? $video->pointOfInterest->qr : '' }}</p>
                                <p><span class="font-weight-bold">Área temática:</span> {{ $video->thematic_area ? $video->thematic_area->name : '' }}</p>
                                <p><span class="font-weight-bold">Creado por:</span> {{ $video->userCreator->login }} {{ $video->date_create->diffForHumans() }}</p>
                                <p><span class="font-weight-bold">Editado por:</span> {{ $video->userUpdater->login }} {{ $video->last_update->diffForHumans() }}</p>
                                <p><span class="font-weight-bold">Calidad:</span> {{ $video->video_items()->pluck('quality')->first() }}</p>
                                <p><span class="font-weight-bold">Formato:</span> {{ $video->video_items()->pluck('format')->first() }}</p>
                                <p><span class="font-weight-bold">Orientation:</span> {{ $video->video_items()->pluck('orientation')->first() }}</p>
                                <p><span class="font-weight-bold">Idioma:</span> {{ $video->video_items()->pluck('language')->first() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('admin.videos.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection

