@extends('plantilla')
@section('content')
<h1 class="mb-4">Assignar conductor a un cotxe</h1>
@include('mensajes')

<form action="{{ route('relacio.guardar') }}" method="POST" class="mx-auto" style="max-width:500px;">
  @csrf
  <div class="mb-3">
    <label class="form-label">Cotxe</label>
    <select name="plate" class="form-select">
      <option value="">-- Elige un coche --</option>
      @foreach ($cars as $c)
        <option value="{{ $c->plate }}" @selected(old('plate') == $c->plate)>{{ $c->plate }} - {{ $c->brand }} {{ $c->model }}</option>
      @endforeach
    </select>
    @error('plate') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Conductor</label>
    <select name="driver_id" class="form-select">
      <option value="">-- Elige un conductor --</option>
      @foreach ($drivers as $d)
        <option value="{{ $d->id }}" @selected(old('driver_id') == $d->id)>{{ $d->nom }} {{ $d->cognoms }} ({{ $d->dni }})</option>
      @endforeach
    </select>
    @error('driver_id') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>

  <button type="submit" class="btn btn-primary">Guardar</button>
  <a href="{{ route('relacio.consultar') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection