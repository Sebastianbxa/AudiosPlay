
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/form_register_audio.css')}}">
@stop

@section('content')

<br><br>
<div class="container">
	<link rel="stylesheet" href="{{asset('css/input_file.css')}}">
	<form action="{{route('admin.update.calificacion', $calificacion->id)}}" class="form" method="POST">
         @csrf 
         @method('PUT') 
        <span class="title">Editar - Calificacion</span>
		<div class="row">
			<div class="col-sm col-md-6"> <input type="text" class="input" id="calificacion" name="calificacion" value="{{$calificacion->calificacion}}" required> </div>
			<div class="col-sm col-md-6"> 
                <button type="submit">Actualizar</button> 
            </div>
		</div>
	</form> <br><br> 
</div>
    
      
@stop



@section('js')    
@stop