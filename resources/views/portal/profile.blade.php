@extends('layouts.padre')

@section('title') 
- Perfil
@endsection

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/card_profile.css')}}">
<link rel="stylesheet" href="{{asset('css/menu_profile.css')}}">
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
						<div class="col-lg-5 col-md-12 mx-auto">
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
						<div class="profile block">
							<!-- PROFILE (MIDDLE-CONTAINER) --><a class="add-button" href="#28"><span class="icon entypo-plus scnd-font-color"></span></a>
							<div class="profile-picture big-profile-picture clear"> <img width="150px" alt="Anne Hathaway picture" src="{{asset('menu/perfil.jpg')}}"> </div>
							<div class="profile-description">
								<p class="scnd-font-color"><strong>Registro </strong> <br> {{ Carbon::parse((auth()->user()->created_at))->translatedFormat('j \de F Y') }} <br> <strong>Pais: </strong> {{(auth()->user()->pais)}}</p>
							</div> <br>
						</div> <br> 
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><br><br>
@endsection


@section('js_padre')
<script src="{{asset('js/menu_profile.js')}}"></script>
@endsection


