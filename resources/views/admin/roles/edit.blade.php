

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center><h1>¡Buen dia!</h1></center>

@stop

@section('content')


    @if (session('info'))
            <div class="alert alert-success">
            {{session('info')}}
            </div>
    @endif


<center><p>Editar permisos</p></center>



    {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'put']) !!}


                <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}

                    @error('name')
                        <small class="text-danger" >
                        {{$message}}
                        </small>
                    @enderror
                </div>

                <h2 class="h3">Lista de permisos</h2>

                @foreach ($permissions as $permission)
                    <div>
                    <label>
                        {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                        {{$permission->description}}
                    </label>     
                    </div>          
                @endforeach
            {!! Form::submit('Actualizar Rol', ['class' => 'btn btn-primary']) !!}
    
    {!! Form::close() !!}



<br><br><br><br>

@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
