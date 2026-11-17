<?php

namespace App\Http\Controllers;

use App\Models\tcars;

class RevisionController extends Controller
{
    public function f_consultar()
    {
        $dades  = tcars::whereHas('revisions')->with('revisions')->orderBy('plate')->get(); // coches CON revisiones
        $dades2 = tcars::doesntHave('revisions')->orderBy('plate')->get();                  // coches SIN revisiones

        return view('consultarrevisions', compact('dades', 'dades2'));
    }
}