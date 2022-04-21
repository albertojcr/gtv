@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <h3 class="font-weight-bold">No tienes permisos para realizar esta acción.</h3>
                <p>Por favor, pinche <a href="{{ route('admin.dashboard')  }}" class="text-white"><b>aquí</b></a> para regresar a la página principal</p>
            </div>
        </div>
    </div>
@endsection
