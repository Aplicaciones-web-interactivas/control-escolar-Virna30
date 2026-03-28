@extends('layouts.app')

@section('title', 'Login - Control Escolar')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Control Escolar</h2>
            <p class="mt-2 text-sm text-gray-600">Ingresa tu correo institucional</p>
        </div>
        
        <div class="bg-white shadow-xl rounded-lg p-8 border border-gray-100">
            <form class="space-y-6" action="{{ route('login.post') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Correo Institucional
                    </label>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           value="{{ old('email') }}" 
                           required
                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink sm:text-sm transition-all duration-300"
                           placeholder="correo@dominio.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-600 leading-relaxed">
                        <span class="font-semibold">Instrucciones:</span><br>
                        Usa <span class="text-neon-pink font-bold">@maestro.com</span> para acceder como maestro<br>
                        Usa <span class="text-neon-pink font-bold">@alumno.com</span> para acceder como alumno
                    </p>
                </div>

                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-neon-pink hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-pink transition-all duration-300 transform hover:scale-105">
                    Entrar
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500">
                    <span class="font-semibold">Ejemplos:</span> profe@maestro.com | juan@alumno.com
                </p>
            </div>
        </div>
    </div>
</div>
@endsection