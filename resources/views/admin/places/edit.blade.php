@extends('admin.layouts.app')

@section('title', 'Guia | Lugares | Editar')

@section('header')
    Editar lugar
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <form action="{{route('admin.places.update',$place)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modificar Lugar</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-label">
                                    <label for="name">Nombre:</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           placeholder="Escribe el nombre de un lugar" value="{{ old('name', $place->name) }}">
                                    {!! $errors->first('name','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="description">Descripcion:</label>
                                    <textarea name="description"
                                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                              placeholder="Escribe una descripcion para un lugar">{{ old("description", $place->description) }}</textarea>
                                    {!! $errors->first('description','<span class="form-text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group has-label">
                                    <label for="place_id">Más lugares:</label>
                                    <select name="place_id" class="selectpicker form-control" data-style="btn btn-info btn-round">
                                        <option value="">Elige un lugar</option>
                                        @foreach($place_relation as $p)
                                            <option value="{{ $p->id }}" {{ old('place_id', $place->place_id) == $p->id ? 'selected' : ''}}>{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('place_id','<span class="form-text text-danger">:message</span>') !!}
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
@endpush
