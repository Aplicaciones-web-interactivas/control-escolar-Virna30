<?php

namespace App\Http\Controllers;
use App\Models\User;  

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        // Determinar rol según el dominio del correo
        if (str_ends_with($email, '@maestro.com')) {
            $role = 'maestro';
            $name = 'Profesor ' . explode('@', $email)[0];
        } elseif (str_ends_with($email, '@alumno.com')) {
            $role = 'alumno';
            $name = 'Alumno ' . explode('@', $email)[0];
        } else {
            return back()->with('error', 'Dominio no permitido. Use @maestro.com o @alumno.com');
        }

        // Buscar o crear usuario
        $user = User::firstOrCreate(
            ['clave_institucional' => $email],
            [
                'name' => $name,
                'rol' => $role,
                'password' => null,
            ]
        );

        // Autenticar al usuario
        Auth::login($user);

        // Redirigir según rol
        if ($user->rol === 'alumno') {
            return redirect('/dashboard/student')->with('success', 'Bienvenido ' . $user->name);
        }

        return redirect('/dashboard/teacher')->with('success', 'Bienvenido ' . $user->name);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('message', 'Sesión cerrada');
    }
}
