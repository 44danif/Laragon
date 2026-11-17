<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ---------- REGISTRO (público: rol siempre 'usuari') ----------
    public function f_registro_form()
    {
        return view('registro');
    }

    public function f_registro(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:3|max:50|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ],
        [
            'name.required'      => 'El usuario es obligatorio.',
            'name.min'           => 'El usuario debe tener al menos 3 caracteres.',
            'name.unique'        => 'Ese usuario ya existe.',
            'email.required'     => 'El email es obligatorio.',
            'email.email'        => 'El email no es válido.',
            'email.unique'       => 'Ese email ya está registrado.',
            'password.required'  => 'La contraseña es obligatoria.',
            'password.min'       => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => 'usuari',   // fijo: nadie puede hacerse admin desde fuera
        ]);

        return redirect()->route('login')->with('success', 'Registrado correctamente. Ya puedes iniciar sesión.');
    }

    // ---------- LOGIN ----------
    public function f_login_form()
    {
        return view('login');
    }

    public function f_login(Request $request)
    {
        $credentials = $request->validate([
            'name'     => 'required',
            'password' => 'required',
        ],
        [
            'name.required'     => 'El usuario es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Bienvenido, ' . Auth::user()->name);
        }

        return back()->withErrors(['name' => 'Usuario o contraseña incorrectos.'])->onlyInput('name');
    }

    // ---------- HAS OLVIDADO EL USUARIO ----------
    public function f_oblidat_form()
    {
        return view('oblidat');
    }

    public function f_oblidat(Request $request)
    {
        $request->validate(
            ['email' => 'required|email'],
            ['email.required' => 'El email es obligatorio.', 'email.email' => 'El email no es válido.']
        );

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->route('oblidat')->with('success', 'Tu usuario es: ' . $user->name);
        }

        return redirect()->route('oblidat')->withInput()
            ->with('error', 'No hay ningún usuario registrado con ese email.');
    }

    // ---------- LOGOUT ----------
    public function f_logout_form()
    {
        return view('logout');
    }

    public function f_logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}