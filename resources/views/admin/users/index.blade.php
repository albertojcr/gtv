@extends('admin.layouts.app')

@section('title', 'Guia | Usuarios')

@section('header')
    Usuarios
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.message')
            <div class="card">
                <div class="card-header">
                    <span class="card-title h4">Lista de usuarios</span>
                </div>
                <div class="card-body">
                    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                      <i class="fas fa-search" aria-hidden="true"></i>
                      <input class="form-control form-control-sm ml-3 w-75" aria-controls="users-table" id="search" type="text" placeholder="Search"
                        aria-label="Search">
                    </form>
                    <div class="table-responsive">
                        <table id='users-table' class="table">
                            <thead class="text-primary">
                            <th lass="text-center">Foto de perfil</th>
                            <th class="text-center">Id</th>
                            <th>Nombre Usuario</th>
                            <th>Correo</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Area tematica</th>
                            <th>Rol</th>
                            <th>Activo</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr style="height: 94px;">
                                    <td class="text-center"><img class="img-fluid rounded-circle " width="90px"
                                                                   src="{{ $user->profile ? Storage::url($user->profile) : '/admin/img/default-avatar.png' }}" /></td>
                                    <td class="text-center">{{ $user->id }}</td>
                                    <td>{{ $user->login }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->surnames }}</td>
                                    <td>{{ $user->thematic_area ? $user->thematic_area->name : 'No esta asignado' }}</td>
                                    <td>
                                        @forelse($user->roles as $role)
                                            @if ($role->name=='Super Administrador')
                                                @continue
                                            @endif
                                            {{ $role->name }}
                                        @empty
                                            No tienes roles asignados
                                        @endforelse
                                    </td>
                                    <td>{{ $user->active == '1' ? 'Sí' : 'No' }}</td>
                                    <td>
                                        @if($user->id !== auth()->user()->id)
                                            @include('admin.users.actions')
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-icon delete">
                                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                                </button>
                                            </form>
                                        @else
                                            @include('admin.users.actions')
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
            var table =    $('#users-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('#search').on( 'keyup', function () {
                        table.search( this.value ).draw();
                    } );
            $('#users-table_filter').hide();
        });
    </script>
    <script>
        $(document).ready(function () {
            let dtable = $('.table');
            dtable.on('click', '.delete', function (e) {
                e.preventDefault();
                swal({
                    title: 'Borrar Usuario',
                    text: "¿Estas seguro que quieres eliminar este usuario?",
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
