@extends('plantilla')
@section('content')
<h1 class="mb-4">Borrar vehículos</h1>
@include('mensajes')

<table class="table table-striped align-middle">
  <thead><tr><th>Matrícula</th><th>Marca</th><th>Modelo</th><th></th></tr></thead>
  <tbody>
    @foreach ($dades as $car)
      <tr>
        <td>{{ $car->plate }}</td>
        <td>{{ $car->brand }}</td>
        <td>{{ $car->model }}</td>
        <td>
          <form action="{{ route('dades.borrarfila', $car->plate) }}" method="POST"
                onsubmit="return confirm('¿Seguro que quieres eliminar {{ $car->plate }}?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
{{ $dades->links() }}

@endsection