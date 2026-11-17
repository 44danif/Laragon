@extends('plantilla')
@section('content')
<h1 class="mb-4">Modificar vehículos</h1>
@include('mensajes')

<table class="table table-striped align-middle">
  <thead><tr><th>Matrícula</th><th>Marca</th><th>Modelo</th><th></th></tr></thead>
  <tbody>
    @foreach ($dades as $car)
      <tr>
        <td>{{ $car->plate }}</td>
        <td>{{ $car->brand }}</td>
        <td>{{ $car->model }}</td>
        <td><a href="{{ route('dades.modificarfila', $car->plate) }}" class="btn btn-warning btn-sm">Actualizar</a></td>
      </tr>
    @endforeach
  </tbody>
</table>
{{ $dades->links() }}
@endsection