<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Usuario registrado</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            <!-- Page Content -->
            <main class="p-20">
                <div class="mt-4 p-4 max-w-lg text-center space-y-4 bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 mx-auto">
                    <h5 class="text-4xl font-bold whitespace-nowrap text-gray-800">GTV</h5>
                    <p class="text-base text-gray-700 sm:text-lg dark:text-gray-400 font-bold">Nuevo registro de usuario</p>
                    <div class="relative w-36 h-36 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 mx-auto">
                        <svg class="w-36 h-36 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="space-y-1">
                        <p class="text-base text-gray-700 sm:text-lg dark:text-gray-400">Nombre: <span class="text-gray-500">{{ $user->name }}</span></p>
                        <p class="text-base text-gray-700 sm:text-lg dark:text-gray-400">Email: <span class="text-gray-500">{{ $user->email }}</span></p>
                        <p class="text-base text-gray-700 sm:text-lg dark:text-gray-400">Rol: <span class="text-gray-500">{{ $user->roles->first()->name }}</span></p>
                    </div>

                    <div>
                        <a href="{{ route('users.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Ir a usuarios
                        </a>
                    </div>
                </div>
            </main>
        </div>

        <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    </body>
</html>
