
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
        <form action="{{route('admin.update.genero', $etiqueta->id)}}"  class="form" method="POST">
            @csrf
            @method('PUT')
            <span class="title">Editar - Genero</span>
            <div class="row">
                <div class="col-sm col-md-6">
                    <input type="text" class="input" id="genero" name="genero"  value="{{$etiqueta->genero}}" required>
                </div>
                <div class="col-sm col-md-6">      
                    <button type="submit">Actualizar</button>
                </div>
              </div>
          </form>
          <br><br>
    </div>
@stop



@section('js')    
@stop