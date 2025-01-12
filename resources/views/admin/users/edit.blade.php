
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center><h1>Rol y Status</h1></center>
@stop

@section('css')
@stop


@section('content')

  
  @if (session('info'))
    <div class="alert alert-success">
      <strong>{{session('info')}}</strong>
    </div>  
  @endif



  <div class="mb-3">
    <br>
    {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}


    <label for="formGroupExampleInput" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">

    <label for="formGroupExampleInput" class="form-label">Estado:</label>
    <input type="text" class="form-control" id="status" name="status" value="{{$user->status}}">

    <br>

    <h2 class="h5">Roles</h2>
    @foreach ($roles as $role)
      <div>
        <label>
            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
            {{$role->name}}
        </label>
      </div>
        
    @endforeach
    {!! Form::submit('Actualizar', ['class' => 'btn btn-primary mt-2']) !!}
    {!! Form::close() !!}
  </div>
@stop


@section('js')
@stop

