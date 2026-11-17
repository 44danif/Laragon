<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuariController extends Controller
{
    // LISTADO (consultar, con botones de modificar y borrar)
    public function f_llistat()
    {
        $dades = User::orderBy('name')->paginate(10);
        return view('usuaris', compact('dades'));
    }

    // CREAR (registreadmin, con desplegable de rol)
    public function f_crear_form()
    {
        return view('registreadmin');
    }

    public function f_crear(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:3|max:50|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'rol'      => 'required|in:usuari,admin',
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
            'rol.required'       => 'Debes elegir un rol.',
            'rol.in'             => 'El rol no es válido.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => $request->rol,
        ]);

        return redirect()->route('usuaris.llistat')->with('success', 'Usuario creado correctamente');
    }

    // MODIFICAR
    public function f_editar_form(User $user)
    {
        return view('modificarusuari', compact('user'));
    }

    public function f_actualitzar(Request $request, User $user)
    {
        $request->validate([
            'name'     => ['required', 'min:3', 'max:50', Rule::unique('users', 'name')->ignore($user->id)],
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|min:8|confirmed',
            'rol'      => 'required|in:usuari,admin',
        ],
        [
            'name.required'      => 'El usuario es obligatorio.',
            'name.min'           => 'El usuario debe tener al menos 3 caracteres.',
            'name.unique'        => 'Ese usuario ya existe.',
            'email.required'     => 'El email es obligatorio.',
            'email.email'        => 'El email no es válido.',
            'email.unique'       => 'Ese email ya está registrado.',
            'password.min'       => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'rol.in'             => 'El rol no es válido.',
        ]);

        // Evita que el único admin se quite el rol y se quede sin acceso
        if ($user->id == Auth::id() && $request->rol !== 'admin') {
            return back()->withInput()->with('error', 'No puedes quitarte a ti mismo el rol de administrador.');
        }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->rol   = $request->rol;
        if ($request->filled('password')) {          // solo cambia la contraseña si se escribe una nueva
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('usuaris.llistat')->with('success', 'Usuario actualizado correctamente');
    }

    // BORRAR
    public function f_borrar(User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->route('usuaris.llistat')->with('error', 'No puedes borrar tu propio usuario.');
        }

        $nombre = $user->name;
        $user->delete();

        return redirect()->route('usuaris.llistat')->with('success', "Usuario $nombre eliminado correctamente");
    }
}