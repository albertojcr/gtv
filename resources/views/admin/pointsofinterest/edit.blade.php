@extends('admin.layouts.app')

@section('title', 'Guia | Puntos de interés | Editar')

@section('header')
    Editar Punto de interés
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <form action="{{route('admin.pointsofinterest.update', $pointsofinterest)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modificar Punto de interes</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-label">
                                    <label for="qr">Codigo qr:</label>
                                    <input type="text" name="qr" class="form-control {{ $errors->has('qr') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe un codigo qr" value="{{ old('qr', $pointsofinterest->qr)  }}">
                                    {!! $errors->first('qr', '<span class="form-text text-danger">:message</span>') !!}
                                </div>
                                <div class="text-center">
                                    <span>Escaner de comprobación: </span>
                                    {!!QrCode::size(300)->generate('https://goo.gl/maps/' . $pointsofinterest->qr) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-label">
                                    <label for="distance">Distancia:</label>
                                    <input type="number" name="distance" class="form-control {{ $errors->has('distance') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la distancia a ese punto en km" value="{{ old('distance', $pointsofinterest->distance) }}">
                                    {!! $errors->first('distance','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="latitude">Latitud:</label>
                                    <input type="number" name="latitude" step="0.0000001" class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la latitud de ese punto" value="{{ old('latitude', $pointsofinterest->latitude) }}">
                                    {!! $errors->first('latitude','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="longitude">Longitud:</label>
                                    <input type="number" name="longitude" step="0.0000001" class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la longitud de ese punto" value="{{ old('longitude', $pointsofinterest->longitude) }}">
                                    {!! $errors->first('longitude','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="place_id">Lugar:</label>
                                    <select name="place_id" class="selectpicker form-control" data-style="btn btn-info btn-round">
                                        <option value="">Elige un lugar</option>
                                        @foreach($places as $place)
                                            <option value="{{ $place->id }}" {{ old('place_id', $pointsofinterest->place_id) == $place->id ? 'selected' : ''}}>{{ $place->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('place_id','<span class="form-text text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-label w-100" >
                                    <label>Areas temáticas</label><br>
                                    <select name="thematicAreas[]"  class="form-control selectpicker {{ $errors->has('thematicAreas') ? 'is-invalid' : '' }}" data-style="btn btn-info btn-round"  multiple="multiple"
                                            data-placeholder="Selecciona una o varias áreas temáticas">
                                        @foreach($thematicAreas as $thematicArea)
                                            <option value="{{ $thematicArea->id }}" {{ collect(old('pointOfInterest', $pointsofinterest->thematicAreas->pluck('id')))->contains($thematicArea->id) ? 'selected' : '' }}>{{ $thematicArea->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('thematicAreas', '<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="title">Nombre:</label>
                                    <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe un titulo para el punto de interés" value="{{ old('title', $pointsofinterest->thematicAreas()->pluck('point_of_interest_thematic_area.title')->first()) }}">
                                    {!! $errors->first('title','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="description">Descripcion:</label>
                                    <textarea name="description"
                                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                              placeholder="Escribe una descripcion del punto de interés">{{ old("description", $pointsofinterest->thematicAreas()->pluck('point_of_interest_thematic_area.description')->first()) }}</textarea>
                                    {!! $errors->first('description','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="language">Idioma:</label>
                                    <input type="text" name="language" class="form-control {{ $errors->has('language') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe un idioma para el punto de interés" value="{{ old('language', $pointsofinterest->thematicAreas()->pluck('point_of_interest_thematic_area.language')->first()) }}">
                                    {!! $errors->first('language','<span class="form-text text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-check text-center">
                            <button type="submit" class="btn btn-primary">Enviar</button>
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
