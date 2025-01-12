@extends('layouts.padre')

@section('title') 
- Contacto
@endsection

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/form_contac.css')}}">
<link rel="stylesheet" href="{{asset('css/social_media.css')}}">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@endsection

@section('contenido')
<div class="fab" style="display: none;">
	<div class="mainop"> <i class="iconn fa-solid fa-plus"></i> </div>
	<div id="forms" class="minifab op1">
		<a href="https://www.facebook.com/profile.php?id=61550270284220&mibextid=2JQ9oc" target="_blank"> <i id="" class="iconn fa-brands fa-facebook"></i> </a>
	</div>
	<div id="drawings" class="minifab op2">
		<a href="https://chat.whatsapp.com/HWWS5sshK4o9i4norp7osr" target="_blank"> <i class="fa-brands fa-whatsapp"></i> </a>
	</div>
	<div id="slides" class="minifab op3">
		<a href={{ "https://www.youtube.com/@Audiosplay."}} target="_blank"> <i class="fa-brands fa-youtube"></i> </a>
	</div>
	<div id="sheets" class="minifab op4">
		<a href={{ "http://tiktok.com/@audiolibros_free"}} target="_blank"> <i class="fa-brands fa-tiktok"></i> </a>
	</div>
</div>
<div class="container5">
	<div class="container4" style="display: none;">
		<div class="content">
			<div class="image-box"> <img src="{{asset('images/contacto.gif')}}" alt=""> </div>
			<form action="{{route('portal.contacto.store')}}" method="POST"> @csrf
				<div class="topic">¡Contactenos!</div>
				
				@if (Auth::check())
					<br>
				@else
				<div class="input-box"> <input type="text" required name="nombre"> <label>Nombre</label> </div>
				<div class="input-box"> <input type="text" name="correo" required> <label>Correo</label> </div>
				@endif
				
				<div class="message-box"> <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Mensaje"></textarea> </div>
				<div class="input-box"> <input type="submit" value="Enviar Mensaje"> </div>
			</form>
		</div>
	</div>
</div>
<div class="email" style="display: none;">
	<p>Mayor información</p>
	<h5>soporte@audiosplay.com</h5> 
</div>
@endsection



@section('js_padre')
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
@if (session('mensaje') == 'ok')
	<script>
	setTimeout(function () {
		Swal.fire(
				'Enviado',
				'Te estaremos notificando',
				'success'
			)
	}, 1500);
	</script>
@endif
@endsection
