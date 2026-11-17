@extends('plantilla')
@section('content')
<h1 class="mb-4">Actualizar vehículo</h1>
@include('mensajes')

<form action="{{ route('dades.actualitzarfila', $fila->plate) }}" method="POST" class="mx-auto" style="max-width:500px;">
  @csrf
  @method('PATCH')

  <div class="mb-3">
    <label for="plate" class="form-label">Matrícula (no se puede modificar)</label>
    <input type="text" class="form-control" id="plate" value="{{ $fila->plate }}" readonly disabled>
    @error('plate') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="brand" class="form-label">Marca</label>
    <input type="text" class="form-control" name="brand" id="brand" value="{{ old('brand', $fila->brand) }}">
    @error('brand') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="model" class="form-label">Modelo</label>
    <input type="text" class="form-control" name="model" id="model" value="{{ old('model', $fila->model) }}">
    @error('model') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label for="color" class="form-label">Color</label>
    <input type="text" class="form-control" name="color" id="color" value="{{ old('color', $fila->color) }}">
    @error('color') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>

  <button type="submit" class="btn btn-primary">Guardar cambios</button>
  <a href="{{ route('dades.modificar') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection