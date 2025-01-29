<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

use Illuminate\Http\Request;

class ClienteAuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.cliente-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('cliente')->attempt($credentials)) {
            return redirect()->route('inicio.inicio');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.cliente-register');
    }

    // Procesar el registro de clientes
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clientes',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $cliente = Cliente::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('cliente')->login($cliente);

        return redirect()->route('cliente.dashboard');
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::guard('cliente')->logout();
        return redirect()->route('cliente.login');
    }
}
