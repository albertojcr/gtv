@extends('admin.layouts.app')

@section('header')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="row">
                        @if((Auth()->user()->hasRole('Administrador')) ||  Auth()->user()->hasRole('Super Administrador') || Auth()->user()->hasPermissionTo('Ver contador de nuevos registros'))
                            @include('admin.statistics.newsThings',['number' => $numberUsers, 'title'=>"Usuarios nuevos", 'icon'=>"fa fa-user"])
                            @include('admin.statistics.newsThings',['number' => $numberPointsOfInterest, 'title'=>"P. de interés nuevos ", 'icon'=>"now-ui-icons location_pin"])
                            @include('admin.statistics.newsThings',['number' => $photos, 'title'=>"Fotografías nuevas" , 'icon'=>"fa fa-camera"])
                            @include('admin.statistics.newsThings',['number' => $videos, 'title'=>"Vídeos nuevos ", 'icon'=>"fa fa-video"])
                        @endif

                        @if((Auth()->user()->hasRole('Administrador')) ||  Auth()->user()->hasRole('Super Administrador') || Auth()->user()->hasPermissionTo('Ver ranking de puntos de intereses'))
                            @include('admin.statistics.ranking')
                        @endif

                        @if((Auth()->user()->hasRole('Administrador')) ||  Auth()->user()->hasRole('Super Administrador') || Auth()->user()->hasPermissionTo('Ver gráfico de visitas'))
                            @include('admin.statistics.chart',['model' => $chartVisit, 'title'=>"Gráfico de visitas"])
                        @endif

                        @if((Auth()->user()->hasRole('Administrador')) ||  Auth()->user()->hasRole('Super Administrador') || Auth()->user()->hasPermissionTo('Ver gráfico de creaciones de puntos de intereses'))
                            @include('admin.statistics.chart',['model' => $chartPointOfInterest, 'title'=>"Gráfico de creaciones de puntos de intereses"])
                        @endif

                        @if((Auth()->user()->hasRole('Administrador')) ||  Auth()->user()->hasRole('Super Administrador') || Auth()->user()->hasPermissionTo('Ver contador de fotos y vídeos registrados'))
                            <div class="card">
                                <div class="card-header">
                                    <span class="card-title h4">Tus archivos subidos:</span>
                                </div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="statistics">
                                                <div class="info">
                                                    <div class="icon icon-primary">
                                                        <i class="now-ui-icons design_image"></i>
                                                    </div>
                                                    <h2 class="info-title">{{count(auth()->user()->photographies)}}</h2>
                                                    <h5 class="stats-title">Fotos</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="statistics">
                                                <div class="info">
                                                    <div class="icon icon-info">
                                                        <i class="now-ui-icons media-1_camera-compact"></i>
                                                    </div>
                                                    <h2 class="info-title">{{ count(auth()->user()->videos) }}</h2>
                                                    <h5 class="stats-title">Vídeos</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush


