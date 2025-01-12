
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
	<h3>Peticiones</h3> <br><br>
	<form action="{{route('admin.peticiones.destroy.all')}}" method="POST"> 
        @csrf 
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar Todo</button> 
    </form><br>
</div>
<div class="container">
	<div class="col-sm col-md-10">
		<table id="table_info" class="table table-striped shadow-lg mt-4">
			<thead class="">
				<tr>
					<th>Titulo</th>
					<th>Autor</th>
					<th>Correo</th>
					<th>Usuario</th>
					<th>Enviado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody> 
                @foreach ($peticiones as $peticione)
				@if ($peticione->status != 1)
				<tr>
					<td>{{$peticione->titulo}}</td>
					<td>{{$peticione->autor}}</td>
					<td>{{$peticione->correo}}</td>
					<td>{{$peticione->user_id}}</td>
					<td>{{$peticione->created_at}}</td>
					<td>
						<a href="{{ route ('portal.peticiones.realizado',$peticione)}}" class="btn btn-primary">Hecho</a>
						<form action="{{ route ('admin.peticiones.destroy',$peticione)}}" method="POST"> 
							@csrf 
							@method('DELETE') 
							<button class="btn btn-danger">Borrar</button> 
						</form>
					</td>	
				</tr>
				@endif 
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
    <script src="{{asset('js/datatable_init.js')}}"></script>    
@stop