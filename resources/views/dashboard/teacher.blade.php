@extends('layouts.app')

@section('title', 'Panel del Maestro')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Panel del Maestro</h1>
        <p class="text-gray-600 mt-1">Gestiona tus grupos y horarios</p>
    </div>

    <!-- Mis Grupos -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-neon-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2C0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Mis Grupos
        </h2>

        @if(isset($grupos) && $grupos->count() > 0)
            <div class="space-y-3">
                @foreach($grupos as $grupo)
                    <div class="bg-gray-50 rounded-lg border border-gray-200 p-4 hover:bg-gray-100 transition-colors duration-150">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="text-base font-semibold text-gray-900">{{ $grupo->nombre }}</h4>
                            @if($grupo->horario)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-neon-pink text-white">
                                    {{ $grupo->horario->dias }} {{ $grupo->horario->hora_inicio }}-{{ $grupo->horario->hora_fin }}
                                </span>
                            @endif
                        </div>
                        <div class="text-sm text-gray-600">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500">Alumnos inscritos:</span>
                                <span class="font-medium text-neon-pink">{{ $grupo->inscripcions->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-gray-500">Ver calificaciones:</span>
                                <a href="{{ route('calificaciones.grupo', $grupo->id) }}" 
                                   class="text-xs px-2 py-1 rounded-full border border-neon-pink text-neon-pink hover:bg-neon-pink hover:text-white transition-all duration-300 font-medium">
                                    Calificaciones
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2C0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <p class="mt-2 text-sm text-gray-500">No tienes grupos creados</p>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('grupos.create') }}" 
           class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-neon-pink rounded-lg p-3 group-hover:bg-pink-600 transition-colors duration-300">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-base font-semibold text-gray-900">Crear Grupo</h3>
                    <p class="text-sm text-gray-500">Nuevo grupo y horario</p>
                </div>
            </div>
        </a>

        <a href="{{ route('assignments.index') }}" 
           class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-neon-pink rounded-lg p-3 group-hover:bg-pink-600 transition-colors duration-300">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012 2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-base font-semibold text-gray-900">Tareas</h3>
                    <p class="text-sm text-gray-500">Crear y ver tareas</p>
                </div>
            </div>
        </a>

        <a href="{{ route('calificaciones.index') }}" 
           class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-neon-pink rounded-lg p-3 group-hover:bg-pink-600 transition-colors duration-300">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002 2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-base font-semibold text-gray-900">Calificaciones</h3>
                    <p class="text-sm text-gray-500">Ver historial</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
