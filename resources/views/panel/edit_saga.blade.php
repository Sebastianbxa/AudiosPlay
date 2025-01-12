
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('content')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Añadir Audiolibro</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </div>
			<div class="modal-body">
				<form action="{{route('admin.edit.sagas.add', $saga)}}" class="form" method="POST" enctype="multipart/form-data"> @csrf
					<div class="row">
						<div class="col-sm col-md-12"> <label for="">Seleccione el audiolibro</label><br> <select class="form-control" name="audiolibro_id" id="audiolibro_id" required>
              <option value="">Listado de audiolibros</option>
              @foreach ($audios as $audio)
              <option value="{{$audio->id}}">{{$audio->titulo}}</option>
              @endforeach
            </select> </div>
					</div> <br> 
          <button type="submit" class="mx-auto btn btn-primary">Crear</button> 
        </form>
			</div>
			<div class="modal-footer"> </div>
		</div>
	</div>
</div> <br><br>
<div class="container">
   @if (sizeof($sagas) > 0)
    <h3> Saga - {{$sagas[0]->sagas->nombre}}</h3>
    <h5> Codigo: {{$sagas[0]->sagas->saga_codigo}}</h5> 
  @endif 
  <br> 
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir Audiolibro</button>
	<div class="col-sm col-md-10" style="margin: 0 auto;">
		<table id="table_info" class="table table-striped shadow-lg mt-4">
			<thead class="">
				<tr>
					<th>Titulo</th>
					<th>Imagen</th>
					<th>Publicado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody> 
        @foreach ($sagas as $saga)
				<tr> {{--
					<td>{{$saga->sagas->saga_codigo}}</td> --}}
					<td>{{$saga->audios->titulo}}</td>
					<td> <img src="{{asset($saga->audios->imagen)}}" width="120px" alt=""> </td>
					<td>{{$saga->created_at}}</td>
					<td>
						<form action="{{ route ('admin.destroy.sagas.audio',$saga)}}" method="POST"> 
              @csrf 
              @method('DELETE')
               <button class="btn btn-danger">Borrar</button> 
            </form>
					</td>
				</tr> 
        @endforeach 
      </tbody>
		</table>
	</div> <br><br> 
</div>


    
      
@stop



@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>    
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>
<script src="{{asset('js/datatable_init.js')}}"></script>

@if (session('mensaje') == 'ok')
    <script>
    Swal.fire(
            '¡Guardado!',
            'Audiolibro Registrado',
            'success'
            )

    </script>
@endif
    
@stop