
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/form_register_audio.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@stop

@section('content')
<br><br>
    <div class="container">
	<form action="{{route('admin.clasificado.store')}}" class="form" method="POST">
        @csrf
		<div class="row"> <label for="">Recomendado:</label> <select name="recomendado" id="recomendado" class="form-control">
            <option value="">Seleccione una opcion</option>
            @foreach ($audios as $audio)
            <option value="{{$audio->id}}">{{$audio->titulo}}</option>
            @endforeach

            </select> <br><br> <label for="">Nuevos:</label> <select name="nuevo" id="nuevo" class="form-control">
            <option value="">Seleccione una opcion</option>
            @foreach ($audios as $audio)
            <option value="{{$audio->id}}">{{$audio->titulo}}</option>
            @endforeach        
            </select> <button type="submit">Crear</button>
        </div>
	</form> <br><br> 
    </div> <br>
    <div class="container">
        <div class="col-sm col-md-8" style="margin: 0 auto;">
            <table id="servicios" class="table table-striped shadow-lg mt-4">
                <thead class="">
                    <tr>
                        <th>Recomendado</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($recomendados as $recomendado)
                    <tr>
                        <td>{{$recomendado->audios->titulo}}</td>
                        <td> <img src="{{asset($recomendado->audios->imagen)}}" width="120px" alt=""> </td>
                        <td>
                            <form action="{{ route ('admin.recomendado.destroy',$recomendado)}}" method="POST"> 
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
    </div> <br>
    <div class="container">
        <div class="col-sm col-md-8" style="margin: 0 auto;">
            <table id="servicios" class="table table-striped shadow-lg mt-4">
                <thead class="">
                    <tr>
                        <th>Nuevos</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($nuevos as $nuevo)
                    <tr>
                        <td>{{$nuevo->audios->titulo}}</td>
                        <td> <img src="{{asset($nuevo->audios->imagen)}}" width="120px" alt=""> </td>
                        <td>
                            <form action="{{ route ('admin.nuevo.destroy',$nuevo)}}" method="POST"> 
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
    </div> <br><br><br>
   
@stop
@section('js')
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    @if (session('mensaje') == 'ok')
        <script>
        Swal.fire(
                '¡Guardado!',
                'Registrado con éxito.',
                'success'
                )

        </script>
    @endif
@stop