@extends('plantilla')
@section('content')

<div class="bg-white p-4 p-md-5 rounded shadow">
  <h1 class="mb-4">On estem</h1>

  <div class="row g-4">
    {{-- Datos de contacto --}}
    <div class="col-md-5">
      <h5>Institut Provençana</h5>
      <p>Carrer de Sant Pius X, 8<br>08901 L'Hospitalet de Llobregat</p>

      <h5>Contacte</h5>
      <p>
        Telèfon: 933 382 553<br>
        Email: <a href="mailto:a8019401@xtec.cat">a8019401@xtec.cat</a><br>
        Web: <a href="https://proven.cat/intraweb/index.php" target="_blank">proven.cat</a>
      </p>

      <h5>Com arribar</h5>
      <ul class="ps-3">
        <li><strong>Metro:</strong> Torrassa (L1)</li>
        <li><strong>FGC:</strong> Sant Josep (L8, R5, R6, S4, S8, S33)</li>
        <li><strong>Bus:</strong> L12 i L16</li>
      </ul>
    </div>

    {{-- Mapa --}}
    <div class="col-md-7">
      <iframe
        src="https://maps.google.com/maps?q=Institut+Provençana,+Carrer+de+Sant+Pius+X+8,+L'Hospitalet+de+Llobregat&output=embed"
        width="100%" height="380" style="border:0;" loading="lazy"
        title="Mapa de l'Institut Provençana"></iframe>
    </div>
  </div>
</div>

@endsection