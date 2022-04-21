<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="/admin/img/apple-icon.png">
    <link rel="icon" type="image/png" href=/admin/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @yield('title', config('app.name'))
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/admin/css/now-ui-dashboard.css?v=1.2.0" rel="stylesheet" />
    <link href="/admin/demo/demo.css" rel="stylesheet" />
    <link  rel="stylesheet" type="text/css" href="/admin/css/datatables.min.css"  />
    <link href="/admin/css/croppie.css" rel="stylesheet">
</head>

<body class="sidebar-mini">
<div class="wrapper">
    @include('admin.partials.sidebar')
    <div class="main-panel">
        @include('admin.partials.nav')
        <div class="panel-header panel-header-sm">
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>

@include('admin.partials.modal')

<script src="/admin/js/core/jquery.min.js"></script>
<script src="/admin/js/core/popper.min.js"></script>
<script src="/admin/js/core/bootstrap.min.js"></script>
<script src="/admin/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="/admin/js/plugins/moment.min.js"></script>
<script src="/admin/js/now-ui-dashboard.min.js?v=1.2.0" type="text/javascript"></script>
<script src="/admin/js/plugins/sweetalert2.min.js"></script>
<script>
    $(document).ready(function () {
        let dtable = $('#logout');
        dtable.on('click', function (e) {
            e.preventDefault();
            swal({
                title: 'Cerrar sesion',
                text: "¿Estas seguro que quieres salir?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Cerrar sesion',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-info',
                buttonsStyling: false
            }).then(function () {
                e.currentTarget.parentElement.submit();
            });
        });
    });
</script>
@stack('scripts')
</body>

</html>
