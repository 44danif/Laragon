@extends('plantilla')
@section('content')
@include('mensajes')

@guest
  <h1>Benvinguts</h1>
  <p>Inicia sessió o registra't per accedir als cotxes i a les seves dades.</p>
  <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
  <a href="{{ route('registro') }}" class="btn btn-outline-primary">Registro</a>
@endguest

@auth
  <h1>Benvingut, {{ Auth::user()->name }}</h1>
  <p>El teu rol és:
    <span class="badge {{ Auth::user()->esAdmin() ? 'bg-danger' : 'bg-secondary' }}">{{ Auth::user()->rol }}</span>
  </p>

  @if (Auth::user()->esAdmin())
    <p>Com a administrador pots gestionar els cotxes i els usuaris.</p>
    <a href="{{ route('usuaris.llistat') }}" class="btn btn-primary">Gestionar usuaris</a>
    <a href="{{ route('dades.consultar') }}" class="btn btn-outline-primary">Gestionar cotxes</a>
  @else
    <p>Pots consultar els cotxes, les revisions i els conductors.</p>
    <a href="{{ route('dades.consultar') }}" class="btn btn-primary">Consultar cotxes</a>
  @endif
@endauth
@endsection