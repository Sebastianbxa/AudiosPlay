

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    
@endsection

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
    <h1>Roles</h1>
    <a href="{{route('admin.roles.create')}}" class="btn btn-primary mb-3 float-right">Nuevo Rol</a>
    <br><br>

@stop

@section('content')


@if (session('info'))
<div class="alert alert-success">
{{session('info')}}
</div>
@endif


<table id="servicios" class="table table-striped shadow-lg mt-4">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ROLES</th>
            <th scope="col">ACCIONES</th>
                    
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td>
                <a class="btn btn-primary mb-3" href="{{route('admin.roles.edit', $role)}}">Editar</a> 
                <form action="{{route('admin.roles.destroy', $role)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary mb-3">Eliminar</button>
                </form>    
            </td>
            
            
            
        </tr>
    @endforeach
        

        
    </tbody>
</table>

<br>


@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>    
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
    $('#servicios').DataTable();
    });
</script>

@endsection


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop



