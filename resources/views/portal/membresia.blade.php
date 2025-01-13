@extends('layouts.padre')

@section('title') 
- Membresia
@endsection

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/card_member.css')}}">
<link rel="stylesheet" href="{{asset('css/card_price_3.css')}}">
@endsection

@section('contenido')
<div class="container5">
  <div class="container4" style="display: none;">
    @if (Auth::check() && $membresia == "Activado")
    <!-- MEMBRESIA VIP -->
    <div class="col-md-12 active-membership">
      <!-- MEMBRESIA VIP -->
      <br>
      <div class="col-md-12" style="margin-top: 140px;">
        <div class="card_check" > <img src="{{asset('images/check.png')}}" >
          <h2>Membresia Activa</h2>
          <p>Eres parte de la Familia AudiosPlay<br> Todos los privilegios adquiridos</p> <button class="button_check">Gracias por el apoyo</button> 
        </div><br>
      </div>
      <br><br>
    @else
    <div class="card-membership">
      <div class="row">
        <div class="col-md-6 text-center membership-intro">
          <i class="fa-solid fa-crown membership-icon"></i>
          <h3 class="membership-heading">Membresía AudiosPlay</h3>
        </div>
        <div class="col-md-6 membership-details">
          <div class="wrapper">
            <div class="table premium shadow-lg">
              <div class="price-section">
                <div class="price-area">
                  @foreach($metodosPago as $metodo)
                  <div class="inner-area" style="margin-bottom: 30px;">
                    <span class="vip-banner">Acceso VIP</span><br>
                    <span class="price">$ {{ number_format($metodo->precio_membresia, 0, ',', '.') }} / Mes</span><br>
                    <span class="price-subtitle">{{ $metodo->precio_membresia_descripcion }}</span>
                  </div>
                  @endforeach
                </div>
              </div>
              <ul class="features">
                <li>
                  <span class="list-name">Acceso a TODO el Contenido</span>
                  <span class="icon check"><i class="fas fa-check"></i></span>
                </li>
                <li>
                  <span class="list-name">Reproductor Online</span>
                  <span class="icon check"><i class="fas fa-check"></i></span>
                </li>
                <li>
                  <span class="list-name">Audiolibros Descargables</span>
                  <span class="icon check"><i class="fas fa-check"></i></span>
                </li>
                <li>
                  <span class="list-name">Prioridad de Peticiones</span>
                  <span class="icon check"><i class="fas fa-check"></i></span>
                </li>
              </ul>
              <div class="btn">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal">Adquirir</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>


<!-- Modal -->
@if($metodosPago->isNotEmpty() && $metodosPago->some(fn($metodo) => $metodo->imagen_metodo_pago_1 || $metodo->imagen_metodo_pago_2 || $metodo->imagen_metodo_pago_3 || $metodo->imagen_metodo_pago_4))
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="font-size: 25px;" class="modal-title" id="exampleModalLabel">Métodos de Pago</h5>
        <a type="button" class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body text-center">
        <!-- Dynamic Payment Methods -->
        <div class="row">
          <!-- First Column -->
          <div class="col-md-6 mb-3">
            @foreach($metodosPago as $metodo)
            @if($metodo->imagen_metodo_pago_1 || $metodo->imagen_metodo_pago_3)
            <div class="card p-3 border rounded text-center mb-3">
              @if($metodo->imagen_metodo_pago_1)
              <img src="{{ asset($metodo->imagen_metodo_pago_1) }}" class="img-fluid mb-2" style="max-width: 150px; margin: 0 auto;">
              <span class="text-dark d-block mb-2" style="font-size: 25px;">{{ $metodo->metodo_pago_1 }}</span>
              @endif
              @if($metodo->imagen_metodo_pago_3)
              <img src="{{ asset($metodo->imagen_metodo_pago_3) }}" class="img-fluid mb-2" style="max-width: 150px; margin: 0 auto;">
              <span class="text-dark d-block" style="font-size: 25px;">{{ $metodo->metodo_pago_3 }}</span>
              @endif
            </div>
            @endif
            @endforeach
          </div>
          <!-- Second Column -->
          <div class="col-md-6 mb-3">
            @foreach($metodosPago as $metodo)
            @if($metodo->imagen_metodo_pago_2 || $metodo->imagen_metodo_pago_4)
            <div class="card p-3 border rounded text-center mb-3">
              @if($metodo->imagen_metodo_pago_2)
              <img src="{{ asset($metodo->imagen_metodo_pago_2) }}" class="img-fluid mb-2" style="max-width: 150px; margin: 0 auto;">
              <span class="text-dark d-block mb-2" style="font-size: 25px;">{{ $metodo->metodo_pago_2 }}</span>
              @endif
              @if($metodo->imagen_metodo_pago_4)
              <img src="{{ asset($metodo->imagen_metodo_pago_4) }}" class="img-fluid mb-2" style="max-width: 150px; margin: 0 auto;">
              <span class="text-dark d-block" style="font-size: 25px;">{{ $metodo->metodo_pago_4 }}</span>
              @endif
            </div>
            @endif
            @endforeach
          </div>
        </div>
        <!-- WhatsApp Button with Icon -->
        <a href="{{ $metodo->whatsapp }}" target="_blank" class="btn btn-success" style="font-size: 20px;">
          <i class="fa-brands fa-whatsapp me-2" ></i> Enviar Comprobante por WhatsApp
        </a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endif

@endsection

@section('js_padre')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection
