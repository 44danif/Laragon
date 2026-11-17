@extends('plantilla')
@section('content')
<h1 class="mb-4">Iniciar sesión</h1>
@include('mensajes')

<form action="{{ route('login') }}" method="POST" class="mx-auto" style="max-width:450px;">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Usuario</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
    @error('name') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Contraseña</label>
    <input type="password" class="form-control" name="password" id="password">
    @error('password') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" name="remember" id="remember">
    <label class="form-check-label" for="remember">Recordar usuario</label>
  </div>

  <button type="submit" class="btn btn-primary">Entrar</button>
  <a href="{{ route('registro') }}" class="btn btn-link">Crear cuenta</a>

  <div class="mt-3">
    <a href="{{ route('oblidat') }}">¿Has olvidado el usuario?</a>
  </div>
</form>
@endsection