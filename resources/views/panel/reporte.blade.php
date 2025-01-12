
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
	<h3>Reportes</h3>
	<form action="{{route('admin.reportes.destroy.all')}}" method="POST"> @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Eliminar Todo</button> {{-- <button class="btn"> <i class="fa-solid fa-trash" style="color: red; font-size:30px;"></i></button> --}} </form>
</div> <br>
<div class="container">
	<div class="col-sm col-md-12">
		<table id="table_info" class="table table-striped shadow-lg mt-4">
			<thead class="">
				<tr>
					<th>Problema</th>
					<th>Correo</th>
					<th>Audiolibro</th>
					<th>Enviado</th>
					<th></th>
				</tr>
			</thead>
			<tbody> 
                @foreach ($reportes as $reporte)
				<tr>
					<td>{{$reporte->problema}}</td>
					<td>{{$reporte->correo}}</td>
					<td>{{$reporte->audios->titulo}}</td>
					<td>{{$reporte->created_at}}</td>
					<td>
						<form action="{{ route ('admin.reportes.destroy',$reporte)}}" method="POST"> 
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
</div> <br> <br><br><br>   
@stop


@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>    
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('js/datatable_init.js')}}"></script>
    
@stop