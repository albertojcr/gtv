@extends('admin.layouts.app')

@section('title', 'Guia | Características de video')

@section('header')
    Características de video
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <form action="{{ route('admin.videoitems.update', $videoitem )}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modificar caracteristicas del video {{ $videoitem->video->description }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <video width="300" height="300" {{ $videoitem->video->route ? 'controls' : '' }}>
                                        <source src="{{ Storage::url($videoitem->video->route) }}" type="video/mp4">
                                    </video>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group has-label">
                                    <label for="quality">Calidad:</label>
                                    <input type="text" name="quality" class="form-control {{ $errors->has('quality') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la calidad del vídeo" value="{{ old('quality', $videoitem->quality) }}">
                                    {!! $errors->first('quality','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="format">Formato:</label>
                                    <input type="text" name="format" class="form-control {{ $errors->has('format') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el formato del vídeo" value="{{ old('format', $videoitem->format) }}">
                                    {!! $errors->first('format','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="orientation">Orientación:</label>
                                    <input type="text" name="orientation" class="form-control {{ $errors->has('orientation') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la orientación del vídeo" value="{{ old('orientation', $videoitem->orientation) }}">
                                    {!! $errors->first('orientation','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-check text-center">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('admin.videos.edit', $videoitem->video->url) }}" class="btn btn-info">Volver</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
