@extends('admin.layouts.app')

@section('title', 'Guia | Áreas Temáticas | Ver')

@section('header')
    Ver Áreas Temáticas
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header">
                    <h4 class="card-title text-center">Área tematica nº {{ $thematicarea->id }}</h4>
                </div>
                <div class="card-body">
                    <p><span class="font-weight-bold">Nombre:</span> {{ $thematicarea->name }}</p>
                    <p><span class="font-weight-bold">Descripcion:</span> {{ $thematicarea->description }}</p>
                </div>
                <div class="text-center">
                    <a href="{{ route('admin.thematicareas.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection

