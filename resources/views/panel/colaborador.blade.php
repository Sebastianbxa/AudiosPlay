
@extends('adminlte::page')
@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@stop

@section('content')


<br><br>
<div class="container">
	<h3>Publicaciones ({{count($audios)}})</h3> <br>
	<div class="col-sm col-md-10" style="margin: 0 auto;">
		<table id="table_info" class="table table-striped shadow-lg mt-4">
			<thead class="">
				<tr>
					<th>Titulo</th>
					<th>Autor</th>
					<th>Genero</th>
					<th>Año</th>
					<th>Publicado</th>
					<th>Visitas</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody> 
                @foreach ($audios as $audio)
				<tr>
					<td>{{$audio->titulo}}</td>
					<td>{{$audio->autors->autor}}</td>
					<td>{{$audio->generos->genero}}</td>
					<td>{{$audio->years->year}}</td>
					<td>{{$audio->created_at}}</td>
					<td>{{$audio->view}}</td>
					<td> 
						<a href="{{ route ('portal.detalles',$audio)}}" class="btn btn-primary" target="_blank">Ver</a>
						<a href="/panel/{{$audio->id}}/edit" class="btn btn-info">Editar</a>
						<form action="{{ route ('admin.publicaciones.destroy',$audio->id)}}" method="POST"> 
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>    
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>
<script src="{{asset('js/datatable_init.js')}}"></script>

@if (session('mensaje') == 'ok')
    <script>
    Swal.fire(
            '¡Guardado!',
            'Servicio registrado con éxito.',
            'success'
            )

    </script>
@endif
    
@stop