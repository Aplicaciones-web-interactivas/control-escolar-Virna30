@extends('layouts.app')

@section('title', 'Calificaciones - Maestro')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Mis Grupos</h1>
        <p class="text-gray-600 mt-1">Selecciona un grupo para ver las calificaciones</p>
    </div>

    <!-- Groups List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        @if(isset($grupos) && $grupos->count() > 0)
            <div class="space-y-3">
                @foreach($grupos as $grupo)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors duration-150">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-sm font-bold text-neon-pink">{{ $grupo->nombre }}</p>
                                @if($grupo->horario)
                                    <p class="text-xs text-gray-500">{{ $grupo->horario->dias }} {{ $grupo->horario->hora_inicio }}-{{ $grupo->horario->hora_fin }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('calificaciones.grupo', $grupo->id) }}" 
                               class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-lg text-xs font-medium text-white bg-neon-pink hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-pink transition-all duration-300 transform hover:scale-105">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012 2h2a2 2 0 012 2"/>
                                </svg>
                                Ver Calificaciones
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2C0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No tienes grupos asignados</h3>
                <p class="mt-1 text-sm text-gray-500">Crea grupos para poder gestionar calificaciones.</p>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="flex justify-center">
        <a href="{{ route('dashboard.teacher') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-neon-pink hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-pink transition-all duration-300">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7l7 7"/>
            </svg>
            Volver al Dashboard
        </a>
    </div>
</div>
@endsection
