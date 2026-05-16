<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Muestra la vista del Login
    public function showLogin()
    {
        return view('login');
    }

    // Procesa el formulario de inicio de sesión
    public function login(Request $request)
    {
        // Validar que los campos no estén vacíos
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar iniciar sesión verificando que el usuario esté activo
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'estado' => 'activo'])) {
            $request->session()->regenerate(); // Seguridad contra fijación de sesiones

            // Redirecciona al dashboard
            return redirect()->intended('dashboard');
        }

        // Si falla, regresa con un error
        return back()->withErrors([
            'login_error' => 'Las credenciales no coinciden o el usuario está inactivo.',
        ])->onlyInput('username');
    }

    // Cerrar Sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}