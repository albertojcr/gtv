@extends('admin.layouts.app')

@section('title', 'Guia | Visitas | Editar')

@section('header')
    Editar Visita
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <form action="{{ route('admin.visits.update',$visit) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Modificar Visita</h4>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-label">
                                    <label for="deviceid">Id del dispositivo:</label>
                                    <input type="text" name="deviceid" class="form-control {{ $errors->has('deviceid') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el Id del dispositivo" value="{{ old('deviceid', $visit->deviceid) }}">
                                    {!! $errors->first('deviceid','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="appversion">Versión de la aplicación</label>
                                    <input type="text" name="appversion" class="form-control {{ $errors->has('appversion') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la versión de la aplicación" value="{{ old('appversion', $visit->appversion) }}">
                                    {!! $errors->first('appversion','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="useragent">Agente de usuario</label>
                                    <input type="text" name="useragent" class="form-control {{ $errors->has('useragent') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el agente de usuario" value="{{ old('useragent', $visit->useragent) }}">
                                    {!! $errors->first('useragent','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="hour">Hora:</label>
                                    <input type="datetime" name="hour" id="hour" class="form-control timepicker {{ $errors->has('hour') ? 'is-invalid' : '' }}"
                                           value="{{ old('hour', $visit->hour ? $visit->hour->format('H:i') : null) }}">
                                    {!! $errors->first('hour','<span class="form-text text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group has-label">
                                    <label for="ssoo">Sistema operativo:</label>
                                    <input type="text" name="ssoo" class="form-control {{ $errors->has('ssoo') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el sistema operativo" value="{{ old('ssoo', $visit->ssoo) }}">
                                    {!! $errors->first('ssoo','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="ssooversion">Versión del sistema operativo:</label>
                                    <input type="text" name="ssooversion" class="form-control {{ $errors->has('ssooversion') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la versión del sistema operativo" value="{{ old('ssooversion', $visit->ssooversion) }}">
                                    {!! $errors->first('ssooversion','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="latitude">Latitud:</label>
                                    <input type="number" step="0.0000001" name="latitude" class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la latitud" value="{{ old('latitude', $visit->latitude) }}">
                                    {!! $errors->first('latitude','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="longitude">Longitud:</label>
                                    <input type="number" step="0.0000001" name="longitude" class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe la latitud" value="{{ old('longitude', $visit->longitude) }}">
                                    {!! $errors->first('longitude','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="point_of_interest_id">Punto de interés:</label>
                                    <select name="point_of_interest_id" class="selectpicker form-control" data-style="btn btn-info btn-round">
                                        <option value="">Elige un punto de interés</option>
                                        @foreach($pointsOfInterest as $pointOfInterest)
                                            <option value="{{ $pointOfInterest->id }}" {{ old('point_of_interest_id', $visit->point_of_interest_id) == $pointOfInterest->id ? 'selected' : ''}}>{{ $pointOfInterest->qr }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('point_of_interest_id','<span class="form-text text-danger">:message</span>') !!}
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
    <script src="/admin/js/plugins/bootstrap-selectpicker.js"></script>
    <script src="/admin/js/plugins/bootstrap-datetimepicker.js"></script>
    <script src="/admin/js/plugins/nouislider.min.js"></script>
    <script src="/admin/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            demo.initDateTimePicker();
            if ($('#hour').length != 0) {
                demo.initSliders();
            }
        });
    </script>
@endpush
