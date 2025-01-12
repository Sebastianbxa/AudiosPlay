
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/form_register_audio.css')}}">
    <link rel="stylesheet" href="{{asset('css/input_file.css')}}">
@stop

@section('content')
<br><br>
<div class="container">
	<form action="{{route('admin.publicaciones.update', $audio->id)}}" class="form" method="POST" enctype="multipart/form-data"> @csrf @method('PUT') <span class="title">Editar</span>
		<div class="row">
			<div class="col-sm col-md-6"> 
        <input type="file" name="imagen" id="imagen" class="input" value="{{$audio->imagen}}"> 
        <input type="text" class="input" id="titulo" name="titulo" placeholder="Titulo" value="{{$audio->titulo}}" required> 
        <textarea name="descripcion" id="descripcion" cols="3" rows="3" class="input">{{$audio->descripcion}}</textarea> 
        <select class="input" name="genero" id="genero" required>
          <option value="{{$audio->genero_id}}">{{$audio->generos->genero}}</option>
          @foreach ($etiquetas as $etiqueta)
          <option value="{{$etiqueta->id}}">{{$etiqueta->genero}}</option>
          @endforeach
        </select> 
        <select class="input" name="autor" id="autor" required>
          <option value="{{$audio->autor_id}}">{{$audio->autors->autor}}</option>
          @foreach ($autors as $autor)
          <option value="{{$autor->id}}">{{$autor->autor}}</option>
          @endforeach
        </select> 
        <select class="input" name="year" id="year" required>
          <option value="{{$audio->year_id}}">{{$audio->years->year}}</option>
          @foreach ($years as $year)
          <option value="{{$year->id}}">{{$year->year}}</option>
          @endforeach
        </select> 
        <select class="input" name="calificacion" id="calificacion" required>
          <option value="{{$audio->calificacion_id}}">{{$audio->calificacions->calificacion}}</option>
          @foreach ($calificacions as $calificacion)
          <option value="{{$calificacion->id}}">{{$calificacion->calificacion}}</option>
          @endforeach
        </select> 
      </div>
			<div class="col-sm col-md-6"> <input type="text" class="input" style="margin-top: 3%" name="time" id="time" placeholder="Duracion" value="{{$audio->time}}" required> <label for="" style="">Reproducir</label> <input type="text" class="input" name="url_a" id="url_a" placeholder="Link 1" value="{{$audio->url_a}}"> <input type="text" class="input" name="url_b" id="url_b" placeholder="Link 2" value="{{$audio->url_b}}"> <input type="text" class="input" name="url_c" id="url_c" placeholder="Link 3" value="{{$audio->url_c}}"> <label for="">Descargar Free</label> <input type="text" class="input" name="download_free" maxlength="200" id="download_free" placeholder="Link Gratis"  value="{{$audio->download_free}}"> <label for="">Descargar - VIP</label> <input type="text" class="input" name="download_1" maxlength="200" id="download_1" placeholder="Link VIP I" value="{{$audio->download_1}}"> <input type="text" class="input" name="download_2" maxlength="200" id="download_2" placeholder="Link VIP II" value="{{$audio->download_2}}"> <button type="submit">Actualizar</button> </div>
		</div>
	</form> <br><br>
 </div>
      
@stop


@section('js')    
@stop