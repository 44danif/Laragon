@extends('plantilla')
@section('content')

<link rel="stylesheet" href="{{ asset('css/nosaltres.css') }}">

<div class="container">

  <div class="nosaltres-cabecera">
    <h1>Nosotros</h1>
    <p>Alquila el coche que necesitas, cuando lo necesites</p>
  </div>

  <div class="nosaltres-tarjeta">
    <h2>Quiénes somos</h2>
    <p>
      Rent Car es una empresa de alquiler de coches con sede en Barcelona. Nacimos con una
      idea sencilla: que alquilar un vehículo sea rápido, claro y sin letra pequeña. Hoy
      ofrecemos una flota de turismos, familiares, descapotables y eléctricos para
      escapadas, viajes de trabajo o estancias largas.
    </p>

    <h2>Cómo funciona</h2>
    <p>
      Eliges el coche, indicas las fechas y recoges las llaves en nuestra oficina. Todos
      nuestros vehículos se revisan antes de cada entrega y llevan seguro a todo riesgo
      incluido. Además, llevamos un registro de la matrícula, marca y modelo de cada coche
      de la flota para que siempre sepas qué estás alquilando.
    </p>

    <h2>Por qué elegirnos</h2>
    <ul>
      <li>Cancelación gratuita hasta 24 horas antes de la recogida.</li>
      <li>Asistencia en carretera las 24 horas, todos los días del año.</li>
    </ul>

    <h2>En cifras</h2>
    <ul>
      <li>Más de 150 vehículosa</li>
      <li>25.000 alquileres realizados</li>
    </ul>
  </div>

</div>

@endsection