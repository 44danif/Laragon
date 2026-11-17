@extends('plantilla')
@section('content')
<h1>Insertar Vehicle</h1>

@if (session('success'))
  <h6 class="alert alert-success">{{ session('success') }}</h6>
@endif
@if (session('messageplateerror'))
  <div class="alert alert-info">{{ session('messageplateerror') }}</div>
@endif

<form action="{{ route('cars.formulario') }}" method="POST">
  @csrf

  <div class="mb-3">
    <label for="plate" class="form-label">Matricula:</label>
    <input type="text" class="form-control" name="plate" id="plate" value="{{ old('plate') }}" placeholder="Introduzca aquí la matrícula (ex. 0000AAA)">
  </div>
  @error('plate')
    <h6 class="alert alert-danger">{{ $message }}</h6>
  @enderror

  <div class="mb-3">
    <label for="brand" class="form-label">Marca:</label>
    <input type="text" class="form-control" name="brand" id="brand" value="{{ old('brand') }}">
  </div>
  @error('brand')
    <h6 class="alert alert-danger">{{ $message }}</h6>
  @enderror

  <div class="mb-3">
    <label for="model" class="form-label">Model:</label>
    <input type="text" class="form-control" name="model" id="model" value="{{ old('model') }}">
  </div>
  @error('model')
    <h6 class="alert alert-danger">{{ $message }}</h6>
  @enderror

  <div class="mb-3">
    <label for="color" class="form-label">Color (opcional):</label>
    <input type="text" class="form-control" name="color" id="color" value="{{ old('color') }}">
  </div>
  @error('color')
    <h6 class="alert alert-danger">{{ $message }}</h6>
  @enderror

  <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection