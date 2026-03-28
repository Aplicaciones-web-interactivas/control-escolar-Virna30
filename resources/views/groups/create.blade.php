@extends('layouts.app')

@section('title', 'Crear Grupo')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Crear Nuevo Grupo</h1>
        <p class="text-gray-600 mt-1">Crea un grupo y añade alumnos por correo</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-lg rounded-lg border border-gray-200 p-8">
        <form class="space-y-6" action="{{ route('groups.store') }}" method="POST">
            @csrf
            
            <!-- Group Name Field -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre del Grupo
                </label>
                <input id="nombre" 
                       name="nombre" 
                       type="text" 
                       value="{{ old('nombre') }}" 
                       required
                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink sm:text-sm transition-all duration-300"
                       placeholder="Ej: Grupo A - Matemáticas">
                @error('nombre')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Students Emails Field -->
            <div>
                <label for="alumnos_emails" class="block text-sm font-medium text-gray-700 mb-2">
                    Correo(s) de Alumno(s)
                </label>
                <textarea id="alumnos_emails" 
                          name="alumnos_emails" 
                          rows="4" 
                          required
                          class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink sm:text-sm transition-all duration-300"
                          placeholder="alumno1@alumno.com, alumno2@alumno.com, alumno3@alumno.com">{{ old('alumnos_emails') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Separa múltiples correos con comas</p>
                @error('alumnos_emails')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Schedule Fields -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="dias" class="block text-sm font-medium text-gray-700 mb-2">
                        Días
                    </label>
                    <select id="dias" 
                            name="dias" 
                            required
                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink sm:text-sm transition-all duration-300">
                        <option value="">Selecciona días...</option>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Lunes, Miércoles, Viernes">Lunes, Miércoles, Viernes</option>
                        <option value="Martes, Jueves">Martes, Jueves</option>
                    </select>
                    @error('dias')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="hora_inicio" class="block text-sm font-medium text-gray-700 mb-2">
                        Hora Inicio
                    </label>
                    <input id="hora_inicio" 
                           name="hora_inicio" 
                           type="time" 
                           value="{{ old('hora_inicio') }}" 
                           required
                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink sm:text-sm transition-all duration-300">
                    @error('hora_inicio')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="hora_fin" class="block text-sm font-medium text-gray-700 mb-2">
                        Hora Fin
                    </label>
                    <input id="hora_fin" 
                           name="hora_fin" 
                           type="time" 
                           value="{{ old('hora_fin') }}" 
                           required
                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink sm:text-sm transition-all duration-300">
                    @error('hora_fin')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboard.teacher') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-neon-pink hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-pink transition-all duration-300">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Crear Grupo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
