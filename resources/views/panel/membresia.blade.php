
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@stop


@section('content')

@php
    use Carbon\Carbon;
    Carbon::setlocale(config('app.locale'));
@endphp


 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Añadir Usuario</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </div>
			<div class="modal-body">
				<form action="{{route('admin.membresia.store')}}" class="form" method="POST"> @csrf
					<div class="row">
						<div class="col-sm col-md-12"> <label for="">Seleccione un usuario</label><br> <select class="form-control" name="user_id" id="user_id" required>
                            <option value="">Listado de usuarios</option>
                            @foreach ($usuarios as $usuario)
                            <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                            @endforeach
                          </select> <br> <label for="">Estado de la membresia</label><br> <select class="form-control" name="status" id="status" required>
                            <option value="">Seleccione una opcion</option>
                            <option value="Activado">Activado</option>
                            <option value="Desactivado">Desactivado</option>
                          </select> </div>
					</div> <br> <button type="submit" class="mx-auto btn btn-primary">Crear</button> </form>
			</div>
			<div class="modal-footer"> </div>
		</div>
	</div>
</div> <br><br>
<div class="container">
	<h3>Membresias</h3> <br> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Añafir</button>
	<div class="col-sm col-md-11" style="margin: 0 auto;">
		<table id="table_info" class="table table-striped shadow-lg mt-4">
			<thead class="">
				<tr>
					<th>Id</th>
					<th>Creacion</th>
					<th>Actualizacion</th>
					<th>Nombre</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
                @foreach ($membresias as $membresia)
				<tr>
					<td>{{$membresia->id}}</td>
					<td> {{ Carbon::parse($membresia->created_at)->translatedFormat('j \de F Y') }}</td>
					<td> {{ Carbon::parse($membresia->updated_at)->translatedFormat('j \de F Y') }}</td>
					<form action="{{route('admin.membresia.update', $membresia->id)}}" class="form" method="POST">
						<td>{{$membresia->usuarios->name}}</td>
						<td> 
                            <select class="form-control" name="status" id="status" required>
                                <option value="{{$membresia->status}}">{{$membresia->status}}</option>
                                @if ($membresia->status == "Activado")
                                    <option value="Desactivado">Desactivado</option>
                                @else
                                <option value="Activado">Activado</option>
                                @endif
                            </select> 
                        </td>
						<td> 
                            @csrf 
                            @method('PUT')
                             <button class="btn btn-primary">Actualiar</button> 
                    </form>
					<form action="{{ route ('admin.membresia.destroy',$membresia)}}" method="POST"> 
                        @csrf 
                        @method('DELETE') 
                        <button class="btn btn-danger">Eliminar</button> 
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{asset('js/datatable_init.js')}}"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>

@if (session('eliminar') == 'ok')
    <script>
    Swal.fire(
            '¡Guardado!',
            'Servicio registrado con éxito.',
            'success'
            )

    </script>
@endif
    
@stop