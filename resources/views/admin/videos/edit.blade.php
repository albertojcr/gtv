@extends('admin.layouts.app')

@section('title', 'Guia | Videos | Editar')

@section('header')
    Editar Video
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <form action="{{route('admin.videos.update', $video)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modificar Video</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-label">
                                    <label for="name">Nombre del vídeo:</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el nombre del vídeo" value="{{ old('name', $video->name) }}">
                                    {!! $errors->first('name','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="route">Ruta:</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="route" class="custom-file-input" id="route" value="{{ old('route', $video->route) }}">
                                            <label class="custom-file-label" for="route">{{ $video->route ? old('route', $video->route) : 'Sube un video' }}</label>
                                        </div>
                                    </div>
                                    {!! $errors->first('route', '<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="point_of_interest_id">Punto de interés:</label>
                                    <select name="point_of_interest_id" class="selectpicker form-control" data-style="btn btn-info btn-round">
                                        <option value="">Elige un punto de interés</option>
                                        @foreach($pointsofinterest as $pointofinterest)
                                            <option value="{{ $pointofinterest->id }}" {{ old('points_of_interest_id', $video->point_of_interest_id) == $pointofinterest->id ? 'selected' : ''}}>{{ $pointofinterest->qr }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('point_of_interest_id', '<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="order">Orden:</label>
                                    <input type="number" name="order" class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el orden del vídeo" value="{{ old('order', $video->order) }}">
                                    {!! $errors->first('order','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                @if(!Auth::user()->hasRole('Alumno'))
                                    <div class="form-group has-label">
                                        <label for="active">Publicado:</label>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="published" value="0" {{ $video->published == '0' ? 'checked' : '' }}>
                                                <span class="form-check-sign"></span>
                                                No
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="published" value="1" {{ $video->published == '1' ? 'checked' : '' }}>
                                                <span class="form-check-sign"></span>
                                                Sí
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group has-label">
                                    <label for="thematic_area_id">Área temática</label>
                                    <select name="thematic_area_id" class="selectpicker form-control" data-style="btn btn-info btn-round">
                                        <option value="">Elige un área temática</option>
                                        @foreach($thematics_areas as $thematic_area)
                                            <option value="{{ $thematic_area->id }}" {{ old('thematic_area_id', $video->thematic_area_id) == $thematic_area->id ? 'selected' : ''}}>{{ $thematic_area->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('thematic_area_id','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-check text-center">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>

                                <div class="form-check text-center">
                                    <a href="{{ route('admin.videoitems.edit', $video->video_items->pluck('url')->first()) }}" class="btn btn-info">Editar caracteristicas de video</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/admin/js/plugins/bootstrap-selectpicker.js"></script>
@endpush
