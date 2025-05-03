<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Citrofrut, SA. De CV.</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-center flex flex-col items-center justify-center min-h-screen">

    <h1 class="text-3xl font-bold text-blue-900 mb-8">Bienvenido al sistema Citrofrut</h1>

    <div class="flex space-x-4">
        <a href="{{ route('login') }}"
           class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Iniciar Sesión
        </a>

        <a href="{{ route('register') }}"
           class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Registrarse
        </a>
    </div>

</body>
</html>
