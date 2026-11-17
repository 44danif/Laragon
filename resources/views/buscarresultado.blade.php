@extends('plantilla')
@section('content')
<p>hola soc resultat</p>
<div class="mx-auto" style="width: 400px;">
  <h3>{{session('success')}}</h3>
<ul>
 @if (count($dades)==0)
     <h3>Mostrar resultat de la cerca</h3>
     <p>sense resultats</p>  
 @else
  <h3>Mostrar resultat de la cerca. Resultats: {{count($dades)}}</h3>
 
 @foreach ($dades as $i)
  <li>{{ $i->plate }} - {{ $i->brand }}</li>  
 @endforeach
 @endif
</ul>
</div>