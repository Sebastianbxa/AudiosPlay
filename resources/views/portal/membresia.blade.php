@extends('layouts.padre')

@section('title') 
- Membresia
@endsection

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/card_poster2.css')}}">
<link rel="stylesheet" href="{{asset('css/card_price_2.css')}}">
<link rel="stylesheet" href="{{asset('css/card_mesege.css')}}">
<link rel="stylesheet" href="{{asset('css/card_select_pay_2.css')}}">
<link rel="stylesheet" href="{{asset('css/card_member.css')}}">
@endsection

@section('contenido')
<div class="container5">
	<div class="container4" style="display: none;">
    @if (Auth::check() && $membresia == "Activado")
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
    <div class="card_membresia">
    <div class="row">
      <div class="col-sm col-md-6" >
        <div class="membresia col-12 text-center">
          <i class="fa-solid fa-crown" ></i>
          <h3 style="font-size: 2.5rem; color:#ffffff;">Membresia AudiosPlay</h3><br><br>
        </div>
      </div>
      <div class="col-sm col-md-6">
        <div class="wrapper">
          <div class="table premium shadow-lg">
            <div class="ribbon"><span>VIP</span></div>
            <div class="price-section">
              <div class="price-area">
                <div class="inner-area"> <span class="text"></span> <span class="price">2</span> </div>
              </div>
            </div>
            <div class="package-name"></div>
            <ul class="features">
              <li> <span class="list-name">Acceso a TODO el Contenido</span> <span class="icon check"><i style="font-size: 30px; " class="fas fa-check"></i></span> </li>
              <li> <span class="list-name">Reproductor Online</span> <span class="icon check"><i style="font-size: 30px; " class="fas fa-check"></i></span> </li>
              <li> <span class="list-name">Audiolibros Descargable</span> <span class="icon check"><i style="font-size: 30px;" class="fas fa-check"></i></span> </li>
              <li> <span class="list-name">Prioridad de Peticiones</span> <span class="icon check"><i style="font-size: 30px;" class="fas fa-check"></i></span> </li>
            </ul>
            <div class="btn"><button data-bs-toggle="modal" data-bs-target="#exampleModal">Adquirir</button></div>
          </div>
        </div> 
    
      </div>
    </div>
    </div><br><br>
  @endif
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="font-size: 25px;" class="modal-title" id="exampleModalLabel">Metodos de Pago</h5> <a type="button" class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></a> </div>
      <div class="modal-body">
        <div>
        </div>
        <form action="{{route('portal.pagos')}}" method="POST"> @csrf
          <div class="flex_prueba"> <label for="radio-card-1" class="radio-card">
            <input type="radio" name="opcion" id="radio-card-1" value="1" checked />
            <div class="card-content-wrapper">
              <span class="check-icon"></span>
              <div class="card-content">
                <img
                  src="{{asset('images/pagos/Paypal.png')}}"
                  alt="" class="pagos"/>
              </div>
            </div>
          </label>
            <label for="radio-card-2" class="radio-card">
            <input type="radio" name="opcion" id="radio-card-2" value="2" />
            <div class="card-content-wrapper">
              <span class="check-icon"></span>
              <div class="card-content">
                <img
                  src="{{asset('images/pagos/Cofee2.png')}}"
                  alt=""class="pagos"/>
              </div>
            </div>
          </label> <label for="radio-card-3" class="radio-card">
            <input type="radio" name="opcion" id="radio-card-3" value="3" />
            <div class="card-content-wrapper">
              <span class="check-icon"></span>
              <div class="card-content">
                <img
                  src="{{asset('images/pagos/Mercado_pago2.png')}}"
                  alt="" class="pagos"/>
              </div>
            </div>
          </label> <label for="radio-card-4" class="radio-card">
            <input type="radio" name="opcion" id="radio-card-4" value="4"/>
            <div class="card-content-wrapper">
              <span class="check-icon"></span>
              <div class="card-content">
                <img
                  src="{{asset('images/pagos/Patreon.png')}}"
                  alt=""class="pagos" />
              </div>
            </div>
          </label>			
          </div>
      </div>
      <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> <button type="submit" class="btn btn-primary">Aceptar</button> </div>
      </form>
    </div>
  </div>
</div> 
<!-- Informacion -->
<div class="email" style="display: none;">
	<p>Mayor información</p>
	<h5>soporte@audiosplay.com</h5> 
</div>
@endsection

@section('js_padre')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection
