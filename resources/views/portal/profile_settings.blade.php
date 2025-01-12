@extends('layouts.padre')

@section('title') 
- Perfil
@endsection

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/card_profile.css')}}">
<link rel="stylesheet" href="{{asset('css/menu_profile.css')}}">
{{---Sweet Alert---}}
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
{{-- Validar Formulario --}}
<script src="{{asset('js/validate_form.js')}}"></script>
@endsection

@section('contenido')
@php
use Carbon\Carbon;
Carbon::setlocale(config('app.locale'));
@endphp

      
<div class="container" style="display: none;  max-width: 1300px;">
	<div class="row">
		<div class="col-sm col-md-12">
			<div class="row">
				<div class="col-lg-12">
					<div class="page-content" style="background-color: #0A2647; text-align:center;">
						<!-- ***** Featured Start ***** -->
						<h3>Perfil de usuario</h3><br>
						<nav class="menu3">
							<section class="menu__container">
								<p class="menu__logo">{{(auth()->user()->name)}}</p>
								<ul class="menu__links">
									<li class="menu__item"> <a href="/account/profile" class="menu__link">Perfil</a> </li>
									<li class="menu__item"> <a href="/account/profile/settings" class="menu__link">Ajustes</a> </li>
								</ul>
								<div class="menu__hamburguer"> <img src="{{asset('menu/burger.svg')}}" class="menu__img"> </div>
							</section>
						</nav>
						<div class="profile block"><br>
							<div class="container">
								<div class="row">
									<div class="col-sm col-md-7">
										<p class="scnd-font-color"><strong>Mi información </strong>
										<form method="POST" action="{{ route('portal.profile.info_reset') }}"> 
											@csrf
											<div class="input-container"> <input type="text" id="name" name="name" class="input_form email text-input" value="{{(auth()->user()->name)}}">
												<div class="input-icon fa-solid fa-user"><span class="fontawesome-envelope scnd-font-color"></span></div>
											</div>
											<div class="input-container"> <input type="text" id="email" name="email" class="input_form email text-input" value="{{(auth()->user()->email)}}">
												<div class="input-icon fa-solid fa-envelope"><span class="fontawesome-envelope scnd-font-color"></span></div>
											</div>
											<div class="input-container"> <input type="text" id="pais" name="pais" class="input_form password text-input" value="{{(auth()->user()->pais)}}">
												<div class="input-icon fa-regular fa-flag"><span class="scnd-font-color"></span></div>
											</div> <button class="button-18" role="button">Actualizar Informacion</button> 
										</form> <br><br><br> 
									</div>
									<div class="col-sm col-md-5">
										<form method="POST" action="{{ route('portal.profile.password_reset') }}" onsubmit="return validarContraseña()"> 
											@csrf
											<div class="input-container">
												<p class="scnd-font-color">Nueva Contraseña</p> <input type="password" class="input_form2 password text-input" id="nuevaContraseña" name="nuevaContraseña" required> </div>
											<div class="input-container">
												<p class="scnd-font-color">Repetir Contraseña</p> <input type="password" class="input_form2 password text-input" id="repetirContraseña" name="repetirContraseña" required> </div> <button class="button-18" role="button" type="submit">Actualizar Contraseña</button> <br><br> </form>
										<p id="mensaje"></p>
									</div>
								</div>
							</div>
						</div> 
					</div>
					<!-- ***** Featured End ***** -->
				</div>
			</div>
		</div>
	</div>
</div><br><br>
@endsection


@section('js_padre')
{{--- Sweet alert ---}}
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="{{asset('js/menu_profile.js')}}"></script>

@if (session('mensaje') == 'ok')
<script>
  setTimeout(function () {
    Swal.fire(
            'Actualizado',
            'Operación realizada con exito',
            'success'
          )
  }, 1500);
</script>
@endif
@endsection





