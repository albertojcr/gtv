@extends('admin.layouts.app')

@section('title', 'Guia | Lugares')

@section('header')
    Lugares
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista de lugares</h4>
                </div>
                <div class="card-body">
                    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                      <i class="fas fa-search" aria-hidden="true"></i>
                      <input class="form-control form-control-sm ml-3 w-75" aria-controls="places-table" id="search" type="text" placeholder="Search"
                        aria-label="Search">
                    </form>
                    <div class="table-responsive">
                        <table id="places-table" class="table">
                            <thead class="text-primary">
                            <th class="text-center">Id</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Más lugares</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($places as $place)
                                <tr>
                                    <td class="text-center">{{ $place->id }}</td>
                                    <td>{{ $place->name }}</td>
                                    <td>{{ $place->description }}</td>
                                    <td>{{ $place->place ? $place->place()->pluck('name')->first() : 'No tiene más lugares' }}</td>
                                    <td>
                                        <a href="{{ route('admin.places.show', $place) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm">
                                            <i class="now-ui-icons location_world"></i>
                                        </a>
                                        <a href="{{ route('admin.places.edit', $place) }}" rel="tooltip" class="btn btn-success btn-icon btn-sm">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                        <form action="{{ route('admin.places.destroy', $place) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon btn-sm delete">
                                                <i class="now-ui-icons ui-1_simple-remove"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script type="text/javascript" src="/admin/js/datatables.min.js"></script>
    <script src="/admin/js/plugins/sweetalert2.min.js"></script>
    <script>
        $(function () {
            var table =    $('#places-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('#search').on( 'keyup', function () {
                        table.search( this.value ).draw();
                    } );
            $('#places-table_filter').hide();
        });


    </script>
    <script>
        $(document).ready(function () {
            let dtable = $('.table');
            dtable.on('click', '.delete', function (e) {
                e.preventDefault();
                swal({
                    title: 'Borrar Lugar',
                    text: "¿Estas seguro que quieres eliminar este lugar?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Borrar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-danger',
                    cancelButtonClass: 'btn btn-info',
                    buttonsStyling: false
                }).then(function () {
                    e.currentTarget.parentElement.submit();
                }, function (dismiss) {
                    if (dismiss === 'cancel') {
                        swal(
                            'Cancelado la operacion',
                        )
                    }
                });
            });
        });
    </script>
@endpush
