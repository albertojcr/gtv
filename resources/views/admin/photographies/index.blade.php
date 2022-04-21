@extends('admin.layouts.app')

@section('title', 'Guia | Fotografias')

@section('header')
    Fotografías
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista de Fotografías</h4>
                </div>
                <div class="card-body">
                    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                      <i class="fas fa-search" aria-hidden="true"></i>
                      <input class="form-control form-control-sm ml-3 w-75" aria-controls="photographies-table" id="search" type="text" placeholder="Search"
                        aria-label="Search">
                    </form>
                    <div class="table-responsive">
                        <table id="photographies-table" class="table">
                            <thead class="text-primary">
                            <th class="text-center">Id</th>
                            <th>Nombre</th>
                            <th>Foto</th>
                            <th>Puntos de interes</th>
                            <th class="text-center">Orden</th>
                            <th class="text-center">Publicado</th>
                            <th>Area tematica</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($photographies as $photography)
                                <tr style="height: 94px;">
                                    <td class="text-center">{{ $photography->id }}</td>
                                    <td class="text_align-center">{{ $photography->name }}</td>
                                    <td><img class="img-fluid" height="60px" width="90px"
                                             src="{{ $photography->route ? Storage::url($photography->route) : '/admin/img/notAvailable.png'}}"/></td>
                                    <td>{{ $photography->point_of_interest ? $photography->point_of_interest->qr : 'No tiene un punto de interes' }}</td>
                                    <td class="text-center">{{ $photography->order }}</td>
                                    <td class="text-center">{{ $photography->published == '1' ? 'Sí' : 'No' }}</td>
                                    <td>{{ $photography->thematic_area ? $photography->thematic_area->name : 'No esta asignado' }}</td>
                                    <td>
                                        <a href="{{ route('admin.photographies.show', $photography) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm">
                                            <i class="fa fa-camera"></i>
                                        </a>
                                        <a href="{{ route('admin.photographies.edit', $photography) }}"
                                           rel="tooltip" class="btn btn-success btn-icon btn-sm">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                        <form action="{{ route('admin.photographies.destroy', $photography) }}"
                                              method="POST" class="d-inline">
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
            var table =    $('#photographies-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('#search').on( 'keyup', function () {
                        table.search( this.value ).draw();
                    } );
            $('#photographies-table_filter').hide();
        });


    </script>

    <script>
        $(document).ready(function () {
            let dtable = $('.table');
            dtable.on('click', '.delete', function (e) {
                e.preventDefault();
                swal({
                    title: 'Borrar Foto',
                    text: "¿Estas seguro que quieres eliminar esta foto?",
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
