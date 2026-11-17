@extends('plantilla')
@section('content')
<h1 class="mb-4">Crear usuario (administrador)</h1>
@include('mensajes')

<form action="{{ route('usuaris.guardar') }}" method="POST" class="mx-auto" style="max-width:450px;">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Usuario</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
    @error('name') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
    @error('email') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Contraseña</label>
    <input type="password" class="form-control" name="password" id="password">
    @error('password') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
  </div>
  <div class="mb-3">
    <label for="rol" class="form-label">Rol</label>
    <select name="rol" id="rol" class="form-select">
      <option value="usuari" @selected(old('rol', 'usuari') == 'usuari')>Usuari</option>
      <option value="admin" @selected(old('rol') == 'admin')>Administrador</option>
    </select>
    @error('rol') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <button type="submit" class="btn btn-primary">Crear usuario</button>
  <a href="{{ route('usuaris.llistat') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection