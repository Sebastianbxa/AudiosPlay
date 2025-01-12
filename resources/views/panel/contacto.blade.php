
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@stop


@section('content')
   <br><br>
    <div class="container">
        <h3>Contacto</h3><br><br>
          <form action="{{route('admin.contactos.destroy.all')}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar Todo</button>
          </form><br>
    </div>
    <div class="container" >
        <div class="col-sm col-md-12" >
            <table id="table_info" class="table table-striped shadow-lg mt-4">
                <thead class="">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Correo</th>
                        <th>Creado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contactos as $contacto)
                        <tr>   
                            <td>{{$contacto->nombre}}</td>
                            <td>{{$contacto->descripcion}}</td>
                            <td>{{$contacto->correo}}</td>
                            <td>{{$contacto->created_at}}</td>  
                            <td>
                                 <form action="{{ route ('admin.contactos.destroy',$contacto)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Borrar</button>
                                </form>
                            </td>
                        </tr> 
                    @endforeach  
                </tbody>
            </table>
        </div>    
    </div>
<br><br><br>      
@stop


@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>    
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('js/datatable_init.js')}}"></script>

@stop