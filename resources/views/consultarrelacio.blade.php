@extends('plantilla')
@section('content')
<h1 class="mb-4">Relació N:M: cotxes i conductors</h1>
@include('mensajes')

<div class="text-center mb-4">
  <img src="{{ asset('img/eer_nm.png') }}" class="img-fluid border rounded" alt="EER N:M">
</div>

@if (Auth::user()->esAdmin())
  <a href="{{ route('relacio.formulari') }}" class="btn btn-primary mb-4">Assignar conductor</a>
@endif

<h4>COTXES AMB CONDUCTOR</h4>
<ul>
  @forelse ($dades as $car)
    <li>
      {{ $car->plate }} - {{ $car->brand }} {{ $car->model }}:
      @foreach ($car->drivers as $d)
        <span class="badge bg-secondary">{{ $d->nom }} {{ $d->cognoms }}</span>
      @endforeach
    </li>
  @empty
    <li>Cap cotxe té conductor.</li>
  @endforelse
</ul>

<h4 class="mt-4">COTXES SENSE CONDUCTOR</h4>
<ul>
  @forelse ($dades2 as $car)
    <li>{{ $car->plate }} - {{ $car->brand }} {{ $car->model }}</li>
  @empty
    <li>Tots els cotxes tenen conductor.</li>
  @endforelse
</ul>

@endsection