<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/fondo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
  <title>Cars</title>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="/p1">ON ESTEM</a></li>
              <li class="nav-item"><a class="nav-link" href="/p2">NOSALTRES</a></li>

              @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('dades.consultar') }}">CONSULTAR</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('dades.buscar') }}">BUSCAR</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('relacio.consultar') }}">CONSULTAR RELACIÓ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('revisions.consultar') }}">CONSULTAR REVISIONS</a></li>

                @if (Auth::user()->esAdmin())
                  <li class="nav-item"><a class="nav-link" href="{{ route('cars.formulario') }}">INSERTAR</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('dades.modificar') }}">MODIFICAR</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('dades.borrar') }}">BORRAR</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('usuaris.llistat') }}">USUARIS</a></li>
                @endif
              @endauth
          </ul>

          <ul class="navbar-nav ms-auto">
              @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">LOGIN</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('registro') }}">REGISTRO</a></li>
              @endguest
              @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('logout.form') }}">LOGOUT ({{ Auth::user()->name }})</a></li>
              @endauth
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main class="container my-5 p-4 p-md-5 rounded shadow" style="background-color: rgba(255,255,255,0.95);">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>