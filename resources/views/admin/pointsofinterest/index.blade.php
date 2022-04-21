@extends('admin.layouts.app')

@section('title', 'Guia | Puntos de Interés')

@section('header')
    Puntos de Interés
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista de puntos de interés</h4>
                </div>
                <div class="card-body">
                    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                      <i class="fas fa-search" aria-hidden="true"></i>
                      <input class="form-control form-control-sm ml-3 w-75" aria-controls="photographies-table" id="search" type="text" placeholder="Search"
                        aria-label="Search">
                    </form>
                    <div class="table-responsive">
                        <table id='pointsofinterest-table' class="table">
                            <thead class="text-primary">
                            <th class="text-center">Id</th>
                            <th>Codigo de barras</th>
                            <th class="text-center">Distancia</th>
                            <th class="text-center">Latitud</th>
                            <th class="text-center">Longitud</th>
                            <th>Lugar</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($pointsofinterests as $pointofinterest)
                                <tr>
                                    <td class="text-center">{{ $pointofinterest->id }}</td>
                                    <td>{{ $pointofinterest->qr }}</td>
                                    <td class="text-center">{{ $pointofinterest->distance }}</td>
                                    <td class="text-center">{{ $pointofinterest->latitude }}</td>
                                    <td class="text-center">{{ $pointofinterest->longitude }}</td>
                                    <td>{{ $pointofinterest->place ? $pointofinterest->place->name : 'No tiene asignado lugar' }}</td>
                                    <td>
                                        <a href="{{ route('admin.pointsofinterest.show', $pointofinterest) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm">
                                            <i class="now-ui-icons location_pin"></i>
                                        </a>
                                        <a href="{{ route('admin.pointsofinterest.edit', $pointofinterest) }}" rel="tooltip" class="btn btn-success btn-icon btn-sm">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                        <form action="{{ route('admin.pointsofinterest.destroy', $pointofinterest) }}" method="POST" class="d-inline">
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
            var table =    $('#pointsofinterest-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('#search').on( 'keyup', function () {
                        table.search( this.value ).draw();
                    } );
            $('#pointsofinterest-table_filter').hide();
        });
    </script>
    <script>
        $(document).ready(function () {
            let dtable = $('.table');
            dtable.on('click', '.delete', function (e) {
                e.preventDefault();
                swal({
                    title: 'Borrar Punto de Interés',
                    text: "¿Estas seguro que quieres eliminar este punto de interés?",
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
