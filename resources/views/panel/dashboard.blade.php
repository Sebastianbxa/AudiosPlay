
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
<link rel="stylesheet" href="{{asset('css/card_dashboard.css')}}">
<!-- Boxicons CDN Link -->
<link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop


@section('content')
<br>
<div class="overview-boxes">
	<div class="box">
	  <div class="right-side2">
		<div class="box-topic">Audiolibros</div>
		<div class="number">{{count($audios)}}</div>
		<div class="indicator ">
			<a href="/panel">
			<span style="color: rgba(185, 180, 180, 0.959)">Ver mas</span>
			</a>
		</div>
	  </div>
	  <i class="fa-solid fa-headphones cart"></i>
	</div>
	<div class="box">
	  <div class="right-side">
		<div class="box-topic">Usuarios</div>
		<div class="number">{{count($usuarios)}}</div>
		<div class="indicator">
			<a href="/admin/users">
			<span style="color: rgba(185, 180, 180, 0.959)">Ver mas</span>
			</a>
		</div>
	  </div>
	  <i class="fa-solid fa-user cart"></i>
	</div>
	<div class="box">
	  <div class="right-side">
		<div class="box-topic">Peticiones</div>
		<div class="number">{{count($peticiones)}}</div>
		<div class="indicator">
			<a href="/panel/peticiones/all">
			<span style="color: rgba(185, 180, 180, 0.959)">Ver mas</span>
			</a>
		</div>
	  </div>
	  <i class="fa-regular fa-note-sticky cart"></i>
	</div>
	<div class="box">
	  <div class="right-side">
		<div class="box-topic">Reportes</div>
		<div class="number">{{count($reportes)}}</div>
		<div class="indicator">
			<a href="/panel/reportes/all">
			<span style="color: rgba(185, 180, 180, 0.959)">Ver mas</span>
			</a>
		</div>
	  </div>
	  <i class="fa-solid fa-circle-exclamation cart"></i>
	</div>
  </div>


@stop


@section('js')    
@stop