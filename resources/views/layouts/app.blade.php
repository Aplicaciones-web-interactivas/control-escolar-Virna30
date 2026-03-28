<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Control Escolar')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'neon-pink': '#FF05A3',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">Control Escolar</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    @if(auth()->check())
                        <span class="text-sm text-gray-600">
                            {{ auth()->user()->name }}
                        </span>
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-sm px-4 py-2 rounded-full border-2 border-neon-pink text-neon-pink hover:bg-neon-pink hover:text-white transition-all duration-300 font-medium">
                                Cerrar Sesión
                            </button>
                        </form>
                        
                        <!-- Dashboard Link -->
                        @if(auth()->user()->rol === 'maestro')
                            <a href="{{ route('dashboard.teacher') }}" 
                               class="text-sm px-3 py-2 rounded-lg text-neon-pink hover:bg-pink-50 transition-all duration-300 font-medium">
                                Panel
                            </a>
                            <a href="{{ route('calificaciones.index') }}" 
                               class="text-sm px-3 py-2 rounded-lg text-neon-pink hover:bg-pink-50 transition-all duration-300 font-medium">
                                Calificaciones
                            </a>
                            <a href="{{ route('grupos.index') }}" 
                               class="text-sm px-3 py-2 rounded-lg text-neon-pink hover:bg-pink-50 transition-all duration-300 font-medium">
                                Mis Grupos
                            </a>
                        @elseif(auth()->user()->rol === 'alumno')
                            <a href="{{ route('dashboard.student') }}" 
                               class="text-sm px-3 py-2 rounded-lg text-neon-pink hover:bg-pink-50 transition-all duration-300 font-medium">
                                Panel
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Success/Error Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif
    </div>
    
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>
</body>
</html>