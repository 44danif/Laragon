@extends('plantilla')
@section('content')
<h1 class="mb-4">Listado de vehículos</h1>
@include('mensajes')

<div class="row g-4">
  @forelse ($dades as $car)
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card h-100 shadow-sm car-card">
        <img src="{{ asset('img/' . $car->plate . '.jpg') }}"
             onerror="this.onerror=null;this.src='{{ asset('img/default.svg') }}';"
             class="card-img-top car-avatar" alt="{{ $car->brand }} {{ $car->model }}">
        <div class="card-body">
          <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
          <p class="card-text text-muted mb-3">{{ $car->plate }}</p>
          <p class="card-text mb-3"><small>Color: {{ $car->color ?? 'Sin especificar' }}</small></p>
          <a href="{{ route('dades.consultardetalle', $car->plate) }}" class="btn btn-primary btn-sm">Ver detalle</a>
        </div>
      </div>
    </div>
  @empty
    <div class="alert alert-warning">No hay vehículos todavía.</div>
  @endforelse
</div>

<div class="mt-4">{{ $dades->links() }}</div>
@endsection