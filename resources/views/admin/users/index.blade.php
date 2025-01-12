



@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection

@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop

@section('content_header')
    <h1>Usuarios ({{count($users)}})</h1>
    <a href="{{route('admin.users.create')}}" class="btn btn-primary mb-3 float-right">Nuevo Usuario</a>
    <br><br>
@stop



@section('content')



            
@if (session('info'))
<div class="alert alert-success">
{{session('info')}}
</div>
@endif

<div class="container">
    <div class="col-sm col-md-11"  style="margin: 0 auto;">
        <table id="table_info" class="table table-striped shadow-lg mt-4">
            <thead class="bg-primary text-white">
                <tr>
                    <th>REGISTRADO</th>
                    <th>NOMBRE</th>
                    <th>CORREO</th>
                    <th>PAIS</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
             
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->pais}}</td>
                    <td>
                    
                    <a class="btn btn-primary" style="margin-bottom: 5px"  href="{{route('admin.users.edit', $user)}}">Config.</a>                
        
                    
                    <form action="{{route('admin.users.destroy', $user)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>         
                    </td>
                </tr>
            @endforeach
                
        
                
            </tbody>
        </table>

    </div>
</div><br><br>


@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>    
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('js/datatable_init.js')}}"></script>
@endsection


@stop



@section('js')
@stop
