<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tcars;
use App\Models\tdrivers;
use App\Models\tcardrivers;

class CarDriverController extends Controller
{
    // Consultar la relación N:M
    public function f_consultar()
    {
        $dades  = tcars::whereHas('drivers')->with('drivers')->get(); // coches CON conductores
        $dades2 = tcars::doesntHave('drivers')->get();                // coches SIN conductores
        return view('consultarrelacio', compact('dades', 'dades2'));
    }

    // Formulario para asignar un conductor a un coche
    public function f_formulari()
    {
        $cars = tcars::orderBy('plate')->get();
        $drivers = tdrivers::orderBy('nom')->get();
        return view('insertarrelacio', compact('cars', 'drivers'));
    }

    public function f_guardar(Request $request)
    {
        $request->validate([
            'plate'     => 'required|exists:tcars,plate',
            'driver_id' => 'required|exists:tdrivers,id',
        ],
        [
            'plate.required'     => 'Debes elegir un coche.',
            'plate.exists'       => 'Ese coche no existe.',
            'driver_id.required' => 'Debes elegir un conductor.',
            'driver_id.exists'   => 'Ese conductor no existe.',
        ]);

        // Error específico: la pareja ya existe
        if (tcardrivers::where('plate', $request->plate)->where('driver_id', $request->driver_id)->doesntExist()) {
            tcardrivers::create(['plate' => $request->plate, 'driver_id' => $request->driver_id]);
            return redirect()->route('relacio.formulari')->with('success', 'Relación creada correctamente');
        }

        return redirect()->route('relacio.formulari')->withInput()
            ->with('error', 'Ese conductor ya está asignado a ese coche.');
    }
}