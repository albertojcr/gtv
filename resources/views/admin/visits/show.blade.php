@extends('admin.layouts.app')

@section('title', 'Guia | Visitas | Ver')

@section('header')
    Ver visita
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header">
                    <h4 class="card-title text-center">Visita nº {{ $visit->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="font-weight-bold">Dispositivo:</span> {{ $visit->deviceid }}</p>
                            <p><span class="font-weight-bold">Hora:</span> {{ $visit->hour ? $visit->hour->format("H:i:s") : '' }}</p>
                            <p><span class="font-weight-bold">Version dispositivo:</span> {{ $visit->appversion }}</p>
                            <p><span class="font-weight-bold">Usuario dispositivo:</span> {{ $visit->useragent }}</p>
                            <p><span class="font-weight-bold">Sistema Operativo:</span> {{ $visit->ssoo }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="font-weight-bold">Version Sistema Operativo:</span> {{ $visit->ssooversion }}</p>
                            <p><span class="font-weight-bold">Latitud:</span> {{ $visit->latitude }}</p>
                            <p><span class="font-weight-bold">Longitud:</span> {{ $visit->longitude }}</p>
                            <p><span class="font-weight-bold">Punto de interés:</span> {{ $visit->point_of_interest ? $visit->point_of_interest->qr : ''  }}</p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('admin.visits.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection



