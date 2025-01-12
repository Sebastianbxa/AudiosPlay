
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/form_register_audio.css')}}">
    <link rel="stylesheet" href="{{asset('css/input_file.css')}}">
@stop


@section('content') <br><br>
<div class="container">
	<form action="{{route('admin.publicaciones.store')}}" class="form" method="POST" enctype="multipart/form-data"> @csrf <span class="title">Nueva Publicacion</span> {{--- <span class="sub mb">Register to get full access now</span> ---}}
		<div class="row">
			<div class="col-sm col-md-6"> <input type="file" name="imagen" id="imagen" class="input">  
        <input type="text" class="input" id="titulo" name="titulo" placeholder="Titulo" required> 
        <select class="input" name="autor" id="autor" required>
          <option value="">Autor</option>
          @foreach ($autors as $autor)
          <option value="{{$autor->id}}">{{$autor->autor}}</option>
          @endforeach
        </select> 
        
        <input type="text" class="input" style="margin-top: 3%" name="time" id="time" placeholder="Duracion" required> 
        <select class="input" name="year" id="year" required>
          <option value="">Año</option>
          @foreach ($years as $year)
          <option value="{{$year->id}}">{{$year->year}}</option>
          @endforeach
        </select> 
        
        <select class="input" name="calificacion" id="calificacion" required>
          <option value="">Calificacion</option>
          @foreach ($calificacions as $calificacion)
          <option value="{{$calificacion->id}}">{{$calificacion->calificacion}}</option>
          @endforeach
        </select> 
        <textarea name="descripcion" id="descripcion" maxlength="2000" cols="3" rows="3" class="input" placeholder="Descripcion" required></textarea> </div>
			  <div class="col-sm col-md-6"> <select class="input" name="genero" id="genero" required>
          <option value="">Genero</option>
          @foreach ($etiquetas as $etiqueta)
          <option value="{{$etiqueta->id}}">{{$etiqueta->genero}}</option>
          @endforeach
          
          </select> 
          <label for="" style="">Reproducir</label> 
          <input type="text" class="input" name="url_a" id="url_a" placeholder="Link 1"> 
          <input type="text" class="input" name="url_b" id="url_b" placeholder="Link 2"> 
          <input type="text" class="input" name="url_c" id="url_c" placeholder="Link 3"> 
          {{-- <label for="">Descargar - Free</label>
          <input type="text" class="input" name="download_free" maxlength="200" id="download_free" placeholder="Link Gratis">  --}}
          <label for="">Descargar - VIP</label>
          <input type="text" class="input" name="download_1" maxlength="200" id="download_1" placeholder="Link VIP I"> 
          <input type="text" class="input" name="download_2" maxlength="200" id="download_2" placeholder="Link VIP II">
          <button type="submit">Crear</button> 
        </div>
		</div>
	</form> <br><br> 
</div>
      
@stop


@section('js')
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>

    @if (session('mensaje') == 'ok')
        <script>
        Swal.fire(
                '¡Guardado!',
                'Audiolibro Registrado',
                'success'
                )

        </script>
    @endif
@stop