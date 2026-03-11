@extends('layouts.app')

@section('title', 'Login - Control Escolar')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Control Escolar</h1>
                <p class="text-gray-600">Ingresa tus credenciales</p>
            </div>

            @if(session('error'))
                <div class="mb-4 text-red-600 font-semibold">{{ session('error') }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Clave Institucional</label>
                    <input type="text" name="clave_institucional" value="{{ old('clave_institucional') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    @error('clave_institucional')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Contraseña</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                    Ingresar
                </button>
            </form>

            <div class="text-center mt-6 text-sm text-gray-600">
                <p>¿No tienes cuenta? <a href="#" class="text-indigo-600 hover:text-indigo-700 font-semibold">Contáctanos</a></p>
            </div>
        </div>
    </div>
</div>
@endsection