@extends('layouts.app')

@section('title', 'Alumnos del Grupo')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Grupo: {{ $grupo->nombre }}</h1>
        <p class="text-gray-600 mt-1">Gestiona las calificaciones de los alumnos</p>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <p class="text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <p class="text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Students Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-l-4 border-neon-pink">
                            Alumno
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Calificación
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($alumnos as $alumno)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $alumno['nombre'] }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                @if($alumno['calificacion'])
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-neon-pink text-white">
                                        {{ number_format($alumno['calificacion'], 1) }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic">Pendiente</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                <form action="{{ route('calificaciones.store') }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                                    <input type="hidden" name="user_id" value="{{ $alumno['id'] }}">
                                    <input type="number" 
                                           name="calificacion" 
                                           value="{{ $alumno['calificacion'] ?? '' }}" 
                                           min="0" 
                                           max="100" 
                                           step="0.01" 
                                           required
                                           class="w-20 px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink">
                                    <button type="submit" 
                                            class="px-3 py-1 text-xs font-medium text-white bg-neon-pink hover:bg-pink-600 rounded transition-colors duration-300">
                                        Guardar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="flex justify-center">
        <a href="{{ route('calificaciones.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-neon-pink hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-pink transition-all duration-300">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7l7 7"/>
            </svg>
            Volver a Mis Grupos
        </a>
    </div>
</div>
@endsection
