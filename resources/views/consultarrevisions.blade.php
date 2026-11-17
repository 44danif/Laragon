@extends('plantilla')
@section('content')
<h1 class="mb-4">Relació 1:N: cotxes i revisions</h1>
@include('mensajes')

<div class="text-center mb-4">
  <img src="{{ asset('img/eer_1n.png') }}" class="img-fluid border rounded" alt="EER 1:N">
</div>

<h4>COTXES AMB REVISIONS</h4>
@forelse ($dades as $car)
  <div class="card mb-3">
    <div class="card-header">
      <strong>{{ $car->plate }}</strong> - {{ $car->brand }} {{ $car->model }}
      <span class="badge bg-secondary float-end">{{ $car->revisions->count() }} revisions</span>
    </div>
    <div class="card-body p-0">
      <table class="table table-sm mb-0">
        <thead><tr><th>Data</th><th>Descripció</th><th>Cost</th></tr></thead>
        <tbody>
          @foreach ($car->revisions as $r)
            <tr>
              <td>{{ $r->data }}</td>
              <td>{{ $r->descripcio }}</td>
              <td>{{ number_format($r->cost, 2) }} €</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@empty
  <div class="alert alert-warning">Cap cotxe té revisions.</div>
@endforelse

<h4 class="mt-4">COTXES SENSE REVISIONS</h4>
<ul>
  @forelse ($dades2 as $car)
    <li>{{ $car->plate }} - {{ $car->brand }} {{ $car->model }}</li>
  @empty
    <li>Tots els cotxes tenen revisions.</li>
  @endforelse
</ul>
@endsection