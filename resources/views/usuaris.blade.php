@extends('plantilla')
@section('content')
<h1 class="mb-4">Usuarios</h1>
@include('mensajes')

<a href="{{ route('usuaris.crear') }}" class="btn btn-primary mb-3">Nuevo usuario</a>

<table class="table table-striped align-middle">
  <thead><tr><th>Usuario</th><th>Email</th><th>Rol</th><th></th></tr></thead>
  <tbody>
    @foreach ($dades as $u)
      <tr>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>
          <span class="badge {{ $u->esAdmin() ? 'bg-danger' : 'bg-secondary' }}">{{ $u->rol }}</span>
        </td>
        <td class="d-flex gap-2">
          <a href="{{ route('usuaris.editar', $u->id) }}" class="btn btn-warning btn-sm">Modificar</a>

          @if ($u->id != Auth::id())
            <form action="{{ route('usuaris.borrar', $u->id) }}" method="POST"
                  onsubmit="return confirm('¿Seguro que quieres eliminar a {{ $u->name }}?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
{{ $dades->links() }}
@endsection