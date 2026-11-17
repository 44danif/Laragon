@extends('plantilla')
@section('content')
<h1 class="mb-4">Modificar usuario</h1>
@include('mensajes')

<form action="{{ route('usuaris.actualitzar', $user->id) }}" method="POST" class="mx-auto" style="max-width:450px;">
  @csrf
  @method('PATCH')
  <div class="mb-3">
    <label for="name" class="form-label">Usuario</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}">
    @error('name') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}">
    @error('email') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="rol" class="form-label">Rol</label>
    <select name="rol" id="rol" class="form-select">
      <option value="usuari" @selected(old('rol', $user->rol) == 'usuari')>Usuari</option>
      <option value="admin" @selected(old('rol', $user->rol) == 'admin')>Administrador</option>
    </select>
    @error('rol') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Nueva contraseña <small class="text-muted">(déjala vacía para no cambiarla)</small></label>
    <input type="password" class="form-control" name="password" id="password">
    @error('password') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
  </div>
  <button type="submit" class="btn btn-primary">Guardar cambios</button>
  <a href="{{ route('usuaris.llistat') }}" class="btn btn-secondary">Volver</a>
</form>
@endsection