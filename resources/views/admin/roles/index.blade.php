@extends('admin.layouts.app')

@section('title', 'Guia | Roles')

@section('header')
    Roles
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <div class="card">
                <div class="card-header">
                    <span class="card-title h4">Lista de roles</span>
                    <div class="float-right">
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-behance"><i class="fa fa-plus"></i> Nuevo rol</a>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                      <i class="fas fa-search" aria-hidden="true"></i>
                      <input class="form-control form-control-sm ml-3 w-75" aria-controls="roles-table" id="search" type="text" placeholder="Search"
                        aria-label="Search">
                    </form>
                    <div class="table-responsive">
                        <table id="roles-table" class="table">
                            <thead class="text-primary">
                            <th class="text-center">Id</th>
                            <th>Nombre</th>
                            <th>Permisos</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    @if ($role->name=='Super Administrador')
                                        @continue
                                    @endif
                                    <td class="text-center">{{ $role->id }}</td>
                                    <td>{{  $role->name }}</td>
                                    <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                    <td>
                                        <a href="{{route('admin.roles.edit', $role)}}" rel="tooltip" class="btn btn-success btn-icon btn-sm">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>

                                        @if($role->name != "Administrador")
                                            <form action="{{route('admin.roles.destroy', $role)}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-icon delete">
                                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                                </button>
                                            </form>
                                        @endif
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
            var table =    $('#roles-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('#search').on( 'keyup', function () {
                        table.search( this.value ).draw();
                    } );
            $('#roles-table_filter').hide();
        });
    </script>

    <script>
        $(document).ready(function () {
            let dtable = $('.table');
            dtable.on('click', '.delete', function (e) {
                e.preventDefault();
                swal({
                    title: 'Borrar Rol',
                    text: "¿Estas seguro que quieres eliminar este rol?",
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

