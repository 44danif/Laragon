@extends('plantilla')
@section('content')
<h1 class="mb-4">¿Has olvidado el usuario?</h1>
@include('mensajes')

<form action="{{ route('oblidat') }}" method="POST" class="mx-auto" style="max-width:450px;">
  @csrf
  <p class="text-muted">Escribe el email con el que te registraste y te diremos tu usuario.</p>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
    @error('email') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
  </div>
  <button type="submit" class="btn btn-primary">Recuperar usuario</button>
  <a href="{{ route('login') }}" class="btn btn-link">Volver al login</a>
</form>
@endsection