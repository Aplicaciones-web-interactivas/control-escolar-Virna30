<?php

namespace App\Http\Controllers;
use App\Models\User;  

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // validaciones
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'clave_institucional' => 'required|string|max:100|unique:users,clave_institucional',
            'password' => 'required|string|min:6|confirmed', // confirmed requiere field password_confirmation
            'role' => 'required|in:alumno,profesor',
        ]);

        // crear usuario con password hasheada
        $user = User::create([
            'name' => $data['name'],
            'clave_institucional' => $data['clave_institucional'],
            'password' => Hash::make($data['password']), // <-- aquí se hashea
            'role' => $data['role'],
        ]);

        // guardar datos mínimos en session (auto-login simple)
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role,
        ]);

        // redirigir según rol (manteniendo tus rutas)
        if ($user->role === 'alumno') {
            return redirect('/alumno/dashboard')->with('message','Registrado y autenticado');
        }

        return redirect('/profesor/dashboard')->with('message','Registrado y autenticado');
    }

    public function login(Request $request)
    {
        $request->validate([
            'clave_institucional' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('clave_institucional', $request->clave_institucional)
                    ->where('password', $request->password) 
                    ->first();

        if (!$user) {
            return back()->with('error', 'Clave o contraseña incorrecta.')->onlyInput('clave_institucional');
        }

        // Guardar en sesión
        session([
            'user_id'   => $user->id,
            'user_name' => $user->name ?? $user->clave_institucional,
            'user_role' => $user->role,
        ]);

        // Redirigir usando el role almacenado en BD
        return $user->role === 'alumno'
            ? redirect('/alumno/dashboard')
            : redirect('/profesor/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['user_id','user_name','user_role']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('message','Sesión cerrada');
    }
}
