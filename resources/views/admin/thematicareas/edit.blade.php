@extends('admin.layouts.app')

@section('title', 'Guia | Áreas Temáticas | Editar')

@section('header')
    Editar Área Temática
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <form action="{{route('admin.thematicareas.update', $thematicarea)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modificar Area Tematica</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-label">
                                    <label for="name">Nombre:</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el nombre de una area tematica" value="{{ old('name', $thematicarea->name) }}">
                                    {!! $errors->first('name','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="description">Descripcion:</label>
                                    <textarea name="description"
                                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                              placeholder="Escribe una descripcion del area">{{ old("description", $thematicarea->description) }}</textarea>
                                    {!! $errors->first('description','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-check text-center">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

