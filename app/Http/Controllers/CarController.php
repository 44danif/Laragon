<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\tcars;

class CarController extends Controller
{
    
    public function f_formulario()
    {
        return view('insertar');
    }

    public function f_guardar(Request $request){
        $request->validate([
            'plate' => 'required|min:7|max:7',
            'brand' => 'required|string|min:2',
            'model' => 'required|min:2',
            'color' => 'nullable|string|max:30'
        ],
        [
            'plate.required' => 'La matrícula es obligatoria.',
            'plate.min'      => 'La matrícula debe tener exactamente 7 caracteres.',
            'plate.max'      => 'La matrícula debe tener exactamente 7 caracteres.',
            'brand.required' => 'La marca es obligatoria.',
            'brand.string'   => 'La marca debe ser una cadena de texto.',
            'brand.min'      => 'La marca debe tener al menos 2 caracteres.',
            'model.required' => 'El modelo es obligatorio.',
            'model.min'      => 'El modelo debe tener al menos 2 caracteres.',
            'color.max' => 'El color no puede tener más de 30 caracteres.',
        ]);

        
        if (tcars::where('plate', $request->plate)->doesntExist()) {
            $car = new tcars();
            $car->plate = $request->plate;
            $car->brand = $request->brand;
            $car->model = $request->model;
            $car->color = $request->color;
            $car->save();

            return redirect()->route('cars.formulario')->with('success', 'Insertado con éxito');
        } else {
            return redirect()->route('cars.formulario')->withInput()->with('messageplateerror', "La matrícula {$request->plate} ya existe.");
        }
    }   

   
    public function f_consultar()
    {
        $dades = tcars::orderBy('plate')->paginate(6);
        return view('consultar', compact('dades'));
    }

    public function f_consultardetalle($plate)
    {
        
        if (tcars::where('plate', $plate)->doesntExist()) {
        return redirect()->route('dades.consultar')
            ->with('error', "No existe ningún vehículo con la matrícula $plate.");
        }

        $car = tcars::find($plate);
        return view('consultardetalle', compact('car'));
    }

   
    public function f_buscar(Request $request)
    {
        $dades = null;
        $modo = null;

        
        if ($request->has('q')) {
            $request->validate(
                ['q' => 'required|min:2'],
                ['q.required' => 'Debes escribir algo para buscar.', 'q.min' => 'Mínimo 2 caracteres.']
            );
            $q = $request->q;
            $dades = tcars::where(function ($w) use ($q) {
                    $w->where('plate', 'like', "$q")
                      ->orWhere('brand', 'like', "$q")
                      ->orWhere('model', 'like', "$q");
                })
                ->orderBy('plate')->paginate(5)->withQueryString();
            $modo = 'simple';
        }
        
        elseif ($request->hasAny(['plate', 'brand', 'model'])) {
            $request->validate([
                'plate' => 'nullable|max:7',
                'brand' => 'nullable|max:50',
                'model' => 'nullable|max:50',
            ]);
            if (!$request->filled('plate') && !$request->filled('brand') && !$request->filled('model')) {
                return redirect()->route('dades.buscar')
                    ->withErrors(['avanzada' => 'Rellena al menos un campo.']);
            }
            $query = tcars::query();
            foreach (['plate', 'brand', 'model'] as $c) {
                if ($request->filled($c)) {
                    $query->where($c, 'like', '%' . $request->$c . '%');
                }
            }
            $dades = $query->orderBy('plate')->paginate(5)->withQueryString();
            $modo = 'avanzada';
        }

        return view('buscar', compact('dades', 'modo'));
    }

    public function f_borrar()
    {
        $dades = tcars::orderBy('plate')->paginate(10);
        return view('borrar', compact('dades'));
    }

    public function f_borrarfila($plate)
    {
    if (tcars::where('plate', $plate)->exists()) {
    tcars::where('plate', $plate)->delete();
    return redirect()->route('dades.borrar')->with('success', "Vehículo $plate eliminado correctamente");
    } else {
        return redirect()->route('dades.borrar')->with('error', "No se puede borrar: el vehículo $plate no existe.");
    }
    }

    
    public function f_modificar()
    {
        $dades = tcars::orderBy('plate')->paginate(10);
        return view('modificar', compact('dades'));
    }

    public function f_modificarfila($plate)
    {
        $fila = tcars::find($plate);
        if (!$fila) {
            return redirect()->route('dades.modificar')->with('error', "No existe el vehículo $plate.");
        }
        return view('modificarfila', compact('fila'));
    }

   public function f_actualitzarfila(Request $request, $plate){
            
            if (tcars::where('plate', $plate)->doesntExist()) {
                return redirect()->route('dades.modificar')
                    ->with('error', "No se puede actualizar: el vehículo $plate no existe.");
            }

            $request->validate([
                'brand' => 'required|string|min:2',
                'model' => 'required|min:2',
                'color' => 'nullable|string|max:30'
            ],
            [
                'brand.required' => 'La marca es obligatoria.',
                'brand.string'   => 'La marca debe ser una cadena de texto.',
                'brand.min'      => 'La marca debe tener al menos 2 caracteres.',
                'model.required' => 'El modelo es obligatorio.',
                'model.min'      => 'El modelo debe tener al menos 2 caracteres.',
                'color.max' => 'El color no puede tener más de 30 caracteres.'
            ]);

            $car = tcars::find($plate);
            $car->brand = $request->brand;
            $car->model = $request->model;
            $car->color = $request->color;
            $car->save();

            return redirect()->route('dades.modificarfila', $plate)->with('success', 'Actualizado correctamente');
    }
        
}