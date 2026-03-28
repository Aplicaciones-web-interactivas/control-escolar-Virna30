@extends('layouts.app')

@section('title', 'Panel del Alumno')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Panel del Alumno</h1>
        <p class="text-gray-600 mt-1">Revisa tus calificaciones y horarios</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Horario Semanal -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Mi Horario Semanal</h3>
            <div class="space-y-4">
                @if(isset($horarios) && $horarios->count() > 0)
                    @foreach($horarios as $horario)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border-l-4 border-neon-pink">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-sm font-bold text-gray-900">{{ $horario->grupo->nombre ?? 'Materia' }}</p>
                                    <p class="text-xs text-gray-500">{{ $horario->dias }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-neon-pink">{{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-6">
                        <p class="text-sm text-gray-500 italic">No hay horarios definidos para tus grupos.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('submissions.index') }}" 
           class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300 group">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-neon-pink rounded-lg p-3 group-hover:bg-pink-600 transition-colors duration-300">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012 2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-base font-semibold text-gray-900">Mis Tareas</h3>
                    <p class="text-sm text-gray-500">Ver tareas asignadas</p>
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
                    <p class="text-sm text-gray-500">Ver historial completo</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
