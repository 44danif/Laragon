<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (Auth::check() && $user->esAdmin()) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Solo los administradores pueden acceder a esa página.');
    }
}