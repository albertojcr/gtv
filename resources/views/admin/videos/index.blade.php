@extends('admin.layouts.app')

@section('title', 'Guia | Videos')

@section('header')
    Videos
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista de videos</h4>
                </div>
                <div class="card-body">
                    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                      <i class="fas fa-search" aria-hidden="true"></i>
                      <input class="form-control form-control-sm ml-3 w-75" aria-controls="videos-table" id="search" type="text" placeholder="Search"
                        aria-label="Search">
                    </form>
                    <div class="table-responsive">
                        <table id="videos-table" class="table">
                            <thead class="text-primary">
                            <th class="text-center">Id</th>
                            <th>Descripción</th>
                            <th class="text-center">Orden</th>
                            <th class="text-center">Publicado</th>
                            <th>Calidad</th>
                            <th>Formato</th>
                            <th>Orientacion</th>
                            <th class="text-center">Idioma</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($videos as $video)
                                <tr>
                                    <td class="text-center">{{ $video->id }}</td>
                                    <td>{{ $video->description }}</td>
                                    <td class="text-center">{{ $video->order }}</td>
                                    <td class="text-center">{{ $video->published == '1' ? 'Sí' : 'No' }}</td>
                                    <td>{{ $video->video_items()->pluck('quality')->first() }}</td>
                                    <td>{{ $video->video_items()->pluck('format')->first() }}</td>
                                    <td>{{ $video->video_items()->pluck('orientation')->first() }}</td>
                                    <td class="text-center">{{ $video->video_items()->pluck('language')->first() }}</td>
                                    <td>
                                        <a href="{{ route('admin.videos.show', $video) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm">
                                            <i class="fa fa-video"></i>
                                        </a>
                                        <a href="{{ route('admin.videos.edit', $video) }}" rel="tooltip" class="btn btn-success btn-icon btn-sm">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                        <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="d-inline">
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
            var table =    $('#videos-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('#search').on( 'keyup', function () {
                        table.search( this.value ).draw();
                    } );
            $('#videos-table_filter').hide();
        });
    </script>

    <script>
        $(document).ready(function () {
            let dtable = $('.table');
            dtable.on('click', '.delete', function (e) {
                e.preventDefault();
                swal({
                    title: 'Borrar Video',
                    text: "¿Estas seguro que quieres eliminar este video?",
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
