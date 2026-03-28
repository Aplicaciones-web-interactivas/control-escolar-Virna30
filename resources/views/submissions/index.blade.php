@extends('layouts.app')

@section('title', 'Mis Tareas')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Mis Tareas</h1>
        <p class="text-gray-600 mt-1">Revisa las tareas asignadas y entrega tus trabajos</p>
    </div>

    @if(count($assignments) > 0)
        <!-- Task Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($assignments as $assignment)
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <!-- Task Header -->
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $assignment->title }}</h3>
                        
                        <!-- Status Badge -->
                        @if($assignment->submissions->isNotEmpty())
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Entregado
                            </span>
                        @elseif($assignment->due_date < now())
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                Vencido
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 102 0V4z" clip-rule="evenodd"/>
                                </svg>
                                Pendiente
                            </span>
                        @endif
                    </div>
                    
                    <!-- Task Description -->
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $assignment->description }}</p>
                    
                    <!-- Task Meta -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ $assignment->user->nombre }}
                        </div>
                        
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2 text-neon-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-medium text-neon-pink">{{ $assignment->due_date->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    
                    <!-- Action Section -->
                    <div class="border-t border-gray-200 pt-4">
                        @if($assignment->submissions->isEmpty() && $assignment->due_date > now())
                            <!-- Upload Form -->
                            <form action="{{ route('submissions.store', $assignment) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                <div class="flex items-center space-x-3">
                                    <input type="file" 
                                           name="file" 
                                           accept=".pdf" 
                                           required
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-neon-pink file:text-white hover:file:bg-pink-600 cursor-pointer">
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-neon-pink hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-pink transition-all duration-300 transform hover:scale-105">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l3-3"/>
                                        </svg>
                                        Subir Entrega
                                    </button>
                                </div>
                            </form>
                        @elseif($assignment->submissions->isNotEmpty())
                            <!-- Download and Edit Section -->
                            <div class="space-y-3">
                                <!-- Status Display -->
                                <div class="space-y-2">
                                    @if($assignment->submissions->first()->calificacion)
                                        <span class="text-sm text-blue-600 font-medium">
                                            <svg class="w-4 h-4 mr-1 inline" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Calificado el {{ $assignment->submissions->first()->created_at->format('d/m/Y H:i') }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            <svg class="w-3 h-3 mr-1 inline" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V3a2 2 0 012-2zm0 2a1 1 0 000 2h8a1 1 0 100-2H4z"/>
                                            </svg>
                                            Nota: {{ $assignment->submissions->first()->calificacion }}
                                        </span>
                                    @else
                                        <span class="text-sm text-green-600 font-medium">
                                            <svg class="w-4 h-4 mr-1 inline" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Entregado el {{ $assignment->submissions->first()->created_at->format('d/m/Y H:i') }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            <svg class="w-3 h-3 mr-1 inline" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V3a2 2 0 012-2zm0 2a1 1 0 000 2h8a1 1 0 100-2H4z"/>
                                            </svg>
                                            Archivo: {{ basename($assignment->submissions->first()->file_path) }}
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex items-center space-x-2">
                                    <!-- Download Button (Always visible) -->
                                    <a href="{{ route('submissions.download', $assignment->submissions->first()) }}" 
                                       class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-lg text-xs font-medium text-white bg-neon-pink hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-pink transition-all duration-300 transform hover:scale-105">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Descargar PDF
                                    </a>
                                    
                                    <!-- Edit Button (Only if still on time AND not graded) -->
                                    @if($assignment->due_date > now() && !$assignment->submissions->first()->calificacion)
                                        <form action="{{ route('submissions.store', $assignment) }}" method="POST" enctype="multipart/form-data" class="inline">
                                            @csrf
                                            <input type="file" 
                                                   name="file" 
                                                   accept=".pdf" 
                                                   required
                                                   class="hidden"
                                                   id="file-upload-{{ $assignment->id }}"
                                                   onchange="this.form.submit()">
                                            <button type="button" 
                                                    onclick="document.getElementById('file-upload-{{ $assignment->id }}').click()"
                                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828L8.586-8.586z"/>
                                                </svg>
                                                Editar Entrega
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @else
                            <!-- Expired -->
                            <div class="text-center py-4">
                                <span class="text-sm text-red-600 font-medium">
                                    <svg class="w-4 h-4 mr-1 inline" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Tiempo de entrega vencido
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay tareas asignadas</h3>
            <p class="mt-1 text-sm text-gray-500">Tu maestro aún no ha asignado ninguna tarea.</p>
        </div>
    @endif
</div>
@endsection
