@component('mail::message')
# Nuevo usuario

Se ha registrado un nuevo usuario en nuestro sistema: {{ $user->name . ' ' . $user->surnames }}
Su nombre de usuario es: {{ $user->login }}<br/>
Su correo electronico es: {{ $user->email }}

@component('mail::button', ['url' => route('admin.users.edit', $user)])
        Editar
@endcomponent
@endcomponent
