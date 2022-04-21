@extends('admin.layouts.app')

@section('title', 'Guia | Visitas')

@section('header')
    Visitas
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista de visitas</h4>
                </div>
                <div class="card-body">
                    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                      <i class="fas fa-search" aria-hidden="true"></i>
                      <input class="form-control form-control-sm ml-3 w-75" aria-controls="visits-table" id="search" type="text" placeholder="Search"
                        aria-label="Search">
                    </form>
                    <div class="table-responsive">
                        <table id="visits-table" class="table">
                            <thead class="text-primary">
                            <th class="text-center">Id</th>
                            <th>Hora</th>
                            <th>Dispositivo</th>
                            <th>Version dispositivo</th>
                            <th>Usuario dispositivo</th>
                            <th>Sistema Operativo</th>
                            <th>Version SO</th>
                            <th>Latitud</th>
                            <th>Longitud</th>
                            <th>Punto de interes</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($visits as $visit)
                                <tr>
                                    <td class="text-center">{{ $visit->id }}</td>
                                    <td>{{ substr($visit->hour, 10, 20) }}</td>
                                    <td>{{ $visit->deviceid }}</td>
                                    <td>{{ $visit->appversion }}</td>
                                    <td>{{ $visit->useragent }}</td>
                                    <td>{{ $visit->ssoo }}</td>
                                    <td>{{ $visit->ssooversion }}</td>
                                    <td>{{ $visit->latitude }}</td>
                                    <td>{{ $visit->longitude }}</td>
                                    <td>{{ $visit->point_of_interest ? $visit->point_of_interest->qr : 'No tiene un punto de interés'}}</td>
                                    <td>
                                        <a href="{{ route('admin.visits.show',$visit) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm">
                                            <i class="now-ui-icons tech_mobile"></i>
                                        </a>
                                        <a href="{{ route('admin.visits.edit',$visit) }}" rel="tooltip" class="btn btn-success btn-icon btn-sm">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                        <form action="{{ route('admin.visits.destroy', $visit) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-icon delete">
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
            var table =    $('#visits-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('#search').on( 'keyup', function () {
                        table.search( this.value ).draw();
                    } );
            $('#visits-table_filter').hide();
        });
    </script>
    <script>
        $(document).ready(function () {
            let dtable = $('.table');
            dtable.on('click', '.delete', function (e) {
                e.preventDefault();
                swal({
                    title: 'Borrar Visita',
                    text: "¿Estas seguro que quieres eliminar esta visita?",
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
