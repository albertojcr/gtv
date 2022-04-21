@extends('admin.layouts.app')

@section('title', 'Guia | Lugares | Ver')

@section('header')
    Ver lugar
@endsection

@section('content')
    <div class="row">
        @if($place->place_id)
            <div class="col-md-6">
                <div class="card">
                    @include('admin.places.show-partial')
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title">Más lugares como:</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-left">
                            <p><span class="font-weight-bold">Nombre:</span> {{ $place->place()->pluck('name')->first() }}</p>
                            <p><span class="font-weight-bold">Descripción:</span> {{ $place->place()->pluck('description')->first() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="card">
                    @include('admin.places.show-partial')
                </div>
            </div>
        @endif
    </div>
@endsection
