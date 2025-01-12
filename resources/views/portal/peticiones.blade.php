@extends('layouts.padre')

@section('title') 
- Peticiones
@endsection

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/form_reportar.css')}}">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@endsection



@section('contenido')
<div class="container" style="display: none; margin-top:4%;">
	<div class="row"> <br>
		<div class="col-sm col-md-12"> <br><br><br>
			<div class="wrapper3">
				<p> Solicitar un Audiolibro</p>
				<form class="form_reportar" action="{{route('portal.peticiones.store')}}" method="POST"> @csrf
					<div class="input-box"> <input type="text" name="titulo" id="titulo" placeholder="Titulo" required> </div>
					<div class="input-box"> <input type="text" name="autor" id="autor" placeholder="Autor" required> </div>
					@if (!Auth::check())
						<div class="input-box"> <input type="email" name="correo" id="correo" placeholder="Correo electronico" required> </div>
					@endif
					<div class="input-box button"> <input type="Submit" value="Solicitar"> </div>
				</form>
			</div>
		</div>
	</div> 
</div><br><br>
@endsection






@section('js_padre')
{{--- Sweet alert ---}}
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





