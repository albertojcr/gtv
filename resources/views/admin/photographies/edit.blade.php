@extends('admin.layouts.app')

@section('title', 'Guia | Fotografias | Editar')

@section('header')
    Editar Foto
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <form action="{{ route('admin.photographies.update', $photography) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modificar Fotografia</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <h4>
                                        <small>Foto o imagen</small>
                                    </h4>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-raised">
                                            <img src="{{ old('route', $photography->route ? Storage::url($photography->route) : '/admin/img/notAvailable.png') }}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                        <div>
                                        <span class="btn btn-raised btn-round btn-default btn-file">
                                            <span class="fileinput-new">Sube una imagen</span>
                                            <span class="fileinput-exists">Cambiar imagen</span>
                                            <input type="file" name="route">
                                        </span>
                                            <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="now-ui-icons ui-1_simple-remove"></i>Borrar imagen</a>
                                        </div>
                                    </div>
                                    {!! $errors->first('route', '<span class="form-text text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-label">
                                    <label for="name">Nombre de la foto:</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el nombre de la foto" value="{{ old('name', $photography->name) }}">
                                    {!! $errors->first('name','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="point_of_interest_id">Punto de interés:</label>
                                    <select name="point_of_interest_id" class="selectpicker form-control" data-style="btn btn-info btn-round">
                                        <option value="">Elige un punto de interés</option>
                                        @foreach($pointsOfInterest as $pointOfInterest)
                                            <option value="{{ $pointOfInterest->id }}" {{ old('point_of_interest_id', $photography->point_of_interest_id) == $pointOfInterest->id ? 'selected' : ''}}>{{ $pointOfInterest->qr }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('point_of_interest_id', '<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="order">Orden:</label>
                                    <input type="num" name="order" class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el orden de la foto" value="{{ old('order', $photography->order) }}">
                                    {!! $errors->first('order','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                @if(!Auth::user()->hasRole('Alumno'))
                                    <div class="form-group has-label">
                                        <label for="active">Publicado:</label>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="published" value="0" {{ $photography->published == '0' ? 'checked' : '' }}>
                                                <span class="form-check-sign"></span>
                                                No
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="published" value="1" {{ $photography->published == '1' ? 'checked' : '' }}>
                                                <span class="form-check-sign"></span>
                                                Sí
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group has-label">
                                    <label for="thematic_area_id">Área temática</label>
                                    <select name="thematic_area_id" class="selectpicker form-control" data-style="btn btn-info btn-round">
                                        <option value="">Elige una área temática</option>
                                        @foreach($thematic_areas as $thematic_area)
                                            <option value="{{ $thematic_area->id }}" {{ old('thematic_area_id', $photography->thematic_area_id) == $thematic_area->id ? 'selected' : ''}}>{{ $thematic_area->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('thematic_area_id','<span class="form-text text-danger">:message</span>') !!}
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

@push('scripts')
    <script src="/admin/js/plugins/jasny-bootstrap.min.js"></script>
    <script src="/admin/js/plugins/bootstrap-selectpicker.js"></script>
@endpush
