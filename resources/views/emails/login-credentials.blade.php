@component('mail::message')
    <h1>Bienvenido {{ $user->name }}</h1>
    <h2>Te has registrado en nuestra aplicacion: {{ config('app.name') }}</h2>
    <p>Tus datos son:</p>
    <li>Nombre usuario: {{ $user->login }}</li>
    <li>Correo: {{ $user->email }}</li>

    Tus credenciales son: {{ $password }}

    Muchas gracias por tu colaboracion y por formar parte en este proyecto

@component('mail::button', ['url' => route('login')])
Iniciar sesion
@endcomponent

@endcomponent
