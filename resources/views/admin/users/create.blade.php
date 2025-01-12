

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
@stop


@section('content_header')
<br>
<center><h1>Crear usuario</h1></center>

@stop

@section('content')


    <br>
    <form action="/users" method="POST">
      @csrf
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Correo</label>
        <input type="text" class="form-control" id="email" name="email">
      </div>

      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Contraseña</label>
        <input type="text" class="form-control" id="password" name="password">
      </div>

      <a href="/servicios" class="btn btn-secondaey" tabindex="5">Cancelar</a>
      <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>

    </form>



@stop


@section('js')
@stop
