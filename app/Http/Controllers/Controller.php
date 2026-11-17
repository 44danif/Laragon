<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    // Si el usuario no es administrador, corta con un error 403
    protected function soloAdmin(): void
    {
        if (!Auth::user()->esAdmin()) {
            abort(403, 'Solo los administradores pueden acceder a esta página.');
        }
    }
}