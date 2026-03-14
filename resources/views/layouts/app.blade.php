<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Control Escolar')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <nav>
        <ul>
            <li><a href="{{ route('index.materias') }}">Materias</a></li>
            <li><a href="{{ route('horarios.index') }}">Horarios</a></li>
            <li><a href="{{ route('grupos.index') }}">Grupos</a></li>
        </ul>
    </nav>
    <div class="container mx-auto py-12">
        @yield('content')
    </div>
    
</body>
</html>