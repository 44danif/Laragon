@extends('plantilla')
@section('content')
<h1 class="mb-4">Buscar vehículos</h1>
@include('mensajes')

<div class="row g-4 mb-4">
  
  <div class="col-md-5">
    <div class="card p-3 h-100">
      <h5>Búsqueda simple</h5>
      <p class="text-muted small">Busca en matrícula, marca y modelo a la vez.</p>
      <form action="{{ route('dades.buscar') }}" method="GET">
        @error('q') <div class="alert alert-danger">{{ $message }}</div> @enderror
        <input type="text" name="q" class="form-control mb-2" placeholder="Ej: Seat, 1234..." value="{{ request('q') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
      </form>
    </div>
  </div>

  
  <div class="col-md-7">
    <div class="card p-3 h-100">
      <h5>Búsqueda por varios campos</h5>
      <p class="text-muted small">Rellena los que quieras; se combinan todos.</p>
      <form action="{{ route('dades.buscar') }}" method="GET">
        @error('avanzada') <div class="alert alert-danger">{{ $message }}</div> @enderror
        @error('plate') <div class="alert alert-danger">{{ $message }}</div> @enderror
        <div class="row g-2 mb-2">
          <div class="col"><input type="text" name="plate" class="form-control" placeholder="Matrícula" value="{{ request('plate') }}"></div>
          <div class="col"><input type="text" name="brand" class="form-control" placeholder="Marca" value="{{ request('brand') }}"></div>
          <div class="col"><input type="text" name="model" class="form-control" placeholder="Modelo" value="{{ request('model') }}"></div>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="{{ route('dades.buscar') }}" class="btn btn-outline-secondary">Limpiar</a>
      </form>
    </div>
  </div>
</div>

@if ($dades !== null)
  @if ($dades->isEmpty())
    <div class="alert alert-warning">No se han encontrado vehículos con esos criterios.</div>
  @else
    <h5>Resultados: {{ $dades->total() }}</h5>
    <table class="table table-striped align-middle">
      <thead><tr><th></th><th>Matrícula</th><th>Marca</th><th>Modelo</th><th></th></tr></thead>
      <tbody>
        @foreach ($dades as $car)
          <tr>
            <td>
              <img src="{{ asset('img/' . $car->plate . '.jpg') }}"
                   onerror="this.onerror=null;this.src='{{ asset('img/default.svg') }}';"
                   class="rounded-circle avatar-mini" alt="">
            </td>
            <td>{{ $car->plate }}</td>
            <td>{{ $car->brand }}</td>
            <td>{{ $car->model }}</td>
            <td><a href="{{ route('dades.consultardetalle', $car->plate) }}" class="btn btn-sm btn-primary">Detalle</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $dades->links() }}
  @endif
@endif
@endsection