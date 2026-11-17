@extends('plantilla')
@section('content')
<div class="card mx-auto shadow detalle-card">
  <img src="{{ asset('img/' . $car->plate . '.jpg') }}"
       onerror="this.onerror=null;this.src='{{ asset('img/default.svg') }}';"
       class="card-img-top car-avatar-grande" alt="{{ $car->brand }} {{ $car->model }}">
  <div class="card-body">
    <h3 class="card-title">{{ $car->brand }} {{ $car->model }}</h3>
    <ul class="list-group list-group-flush mb-3">
      <li class="list-group-item"><strong>Matrícula:</strong> {{ $car->plate }}</li>
      <li class="list-group-item"><strong>Marca:</strong> {{ $car->brand }}</li>
      <li class="list-group-item"><strong>Modelo:</strong> {{ $car->model }}</li>
      <li class="list-group-item"><strong>Color:</strong> {{ $car->color ?? 'Sin especificar' }}</li>
    </ul>
    <a href="{{ route('dades.consultar') }}" class="btn btn-secondary">Volver</a>
    @if (Auth::user()->esAdmin())
    <a href="{{ route('dades.modificarfila', $car->plate) }}" class="btn btn-warning">Editar</a>
    @endif
  </div>
</div>
@endsection