@extends('plantilla')
@section('content')
<div class="text-center mx-auto" style="max-width:450px;">
  <h1 class="mb-4">Cerrar sesión</h1>

  @auth
    <p>Estás identificado como <strong>{{ Auth::user()->name }}</strong>.</p>
    <p>¿Seguro que quieres cerrar la sesión?</p>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-danger">Cerrar sesión</button>
      <a href="/" class="btn btn-secondary">Cancelar</a>
    </form>
  @else
    <div class="alert alert-info">No hay ninguna sesión iniciada.</div>
    <a href="{{ route('login') }}" class="btn btn-primary">Ir al login</a>
  @endauth
</div>
@endsection