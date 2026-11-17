<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarDriverController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuariController;

// ---------- PÚBLICAS (cualquiera) ----------
Route::get('/', function () { return view('index'); })->name('home');
Route::get('/p1', function () { return view('onestem'); });
Route::get('/p2', function () { return view('nosaltres'); });

// ---------- SOLO SIN SESIÓN ----------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'f_login_form'])->name('login');
    Route::post('/login', [AuthController::class, 'f_login']);

    Route::get('/registro', [AuthController::class, 'f_registro_form'])->name('registro');
    Route::post('/registro', [AuthController::class, 'f_registro']);

    Route::get('/oblidat', [AuthController::class, 'f_oblidat_form'])->name('oblidat');
    Route::post('/oblidat', [AuthController::class, 'f_oblidat']);
});

// ---------- CON SESIÓN (usuari y admin): solo consultar ----------
Route::middleware('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'f_logout_form'])->name('logout.form');
    Route::post('/logout', [AuthController::class, 'f_logout'])->name('logout');

    Route::get('/consultar', [CarController::class, 'f_consultar'])->name('dades.consultar');
    Route::get('/consultar/{plate}', [CarController::class, 'f_consultardetalle'])->name('dades.consultardetalle');
    Route::get('/buscar', [CarController::class, 'f_buscar'])->name('dades.buscar');

    Route::get('/revisions', [RevisionController::class, 'f_consultar'])->name('revisions.consultar');
    Route::get('/relacio', [CarDriverController::class, 'f_consultar'])->name('relacio.consultar');

    // ---------- SOLO ADMINISTRADORES: el CRUD ----------
    Route::middleware('admin')->group(function () {

        // Coches
        Route::get('/insertar', [CarController::class, 'f_formulario'])->name('cars.formulario');
        Route::post('/insertar', [CarController::class, 'f_guardar']);

        Route::get('/borrar', [CarController::class, 'f_borrar'])->name('dades.borrar');
        Route::delete('/borrar/{plate}', [CarController::class, 'f_borrarfila'])->name('dades.borrarfila');

        Route::get('/modificar', [CarController::class, 'f_modificar'])->name('dades.modificar');
        Route::get('/modificar/{plate}', [CarController::class, 'f_modificarfila'])->name('dades.modificarfila');
        Route::patch('/modificar/{plate}', [CarController::class, 'f_actualitzarfila'])->name('dades.actualitzarfila');

        // Relación N:M (asignar conductores)
        Route::get('/relacio/insertar', [CarDriverController::class, 'f_formulari'])->name('relacio.formulari');
        Route::post('/relacio/insertar', [CarDriverController::class, 'f_guardar'])->name('relacio.guardar');

        // Usuarios
        Route::get('/usuaris', [UsuariController::class, 'f_llistat'])->name('usuaris.llistat');
        Route::get('/usuaris/crear', [UsuariController::class, 'f_crear_form'])->name('usuaris.crear');
        Route::post('/usuaris', [UsuariController::class, 'f_crear'])->name('usuaris.guardar');
        Route::get('/usuaris/{user}/editar', [UsuariController::class, 'f_editar_form'])->name('usuaris.editar');
        Route::patch('/usuaris/{user}', [UsuariController::class, 'f_actualitzar'])->name('usuaris.actualitzar');
        Route::delete('/usuaris/{user}', [UsuariController::class, 'f_borrar'])->name('usuaris.borrar');
    });
});