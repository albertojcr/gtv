
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8"/>
<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="/assets/img/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>
    {{ config('app.name') }} | Olvido de contraseña
</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
      name='viewport'/>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<link href="/admin/css/bootstrap.min.css" rel="stylesheet"/>
<link href="/admin/css/now-ui-dashboard.css?v=1.2.0" rel="stylesheet"/>
</head>

<body class="login-page sidebar-mini">
<nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
<div class="container-fluid">
    <div class="navbar-wrapper">
        <a class="navbar-brand" href="{{ route('login') }}">Guía Turístico Virtual</a>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
    </div>
</div>
</nav>

<div class="wrapper wrapper-full-page ">
<div class="full-page login-page section-image" filter-color="black" id="login-image">
    <div class="content pt-0 pb-0">
        <div class="container">
            <div class="col-md-4 ml-auto mr-auto">
                <div class="card card-login ">
                    <div class="card-header ">
                        <div class="card-title">
                            <div class="text-center">
                                <h4>GTV Administración</h4>
                                <h5>Olvido de contraseña</h5>
                                <p>Introduzca su correo para recibir el enlace para poder restablecer su
                                    contraseña</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="input-group no-border form-control-lg">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="now-ui-icons users_circle-08"></i>
                                    </div>
                                </div>
                                <input id="email" placeholder="Correo Electrónico" type="email"
                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{ old('email') }}" required autocomplete="email"
                                       autofocus>
                                {!! $errors->first('email','<span class="form-text text-danger">:message</span>') !!}
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Restablecer la contraseña"
                                       class="btn btn-primary btn-round btn-lg btn-block mb-3">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="copyright" id="copyright">
                &copy;
                <script>
                    document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                </script>
                , Desarrollado por
                <span>Fran Arce Codina, Jorge Orenes Rubio Y Fulgencio Valera Alonso</span>.
            </div>
        </div>
    </footer>
</div>
</div>

<script src="/admin/js/core/jquery.min.js"></script>
<script src="/admin/js/core/bootstrap.min.js"></script>
<script src="/admin/js/now-ui-dashboard.min.js?v=1.2.0" type="text/javascript"></script>
<script>
$("#login-image").css('background-image', 'url("/admin/img/bg15.jpg")');
</script>
</body>

</html>

