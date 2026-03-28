<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión');
        }

        $userRole = auth()->user()->rol;
        
        // Mapeo de roles
        $roleMap = [
            'teacher' => 'maestro',
            'student' => 'alumno',
        ];

        $expectedRole = $roleMap[$role] ?? $role;

        if ($userRole !== $expectedRole) {
            abort(403, 'No tienes permisos para acceder a esta página');
        }

        return $next($request);
    }
}
