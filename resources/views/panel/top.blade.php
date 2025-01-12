
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@stop

@section('content')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Añadir Audiolibro</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </div>
			<div class="modal-body">
				<form action="{{route('admin.top.store',)}}" class="form" method="POST"> @csrf
					<div class="row">
						<div class="col-sm col-md-12"> <label for="">Seleccione el audiolibro</label><br> <select class="form-control" name="audiolibros_id" id="audiolibros_id" required>
                            <option value="">Listado de audiolibros</option>
                            @foreach ($audios as $audio)
                            <option value="{{$audio->id}}">{{$audio->titulo}}</option>
                            @endforeach
                          </select> <br> <label for="">No. de Posicion</label><br> <input type="text" class="form-control" id="posicion" name="posicion" required> </div>
					</div> <br> <button type="submit" class="mx-auto btn btn-primary">Crear</button> </form>
			</div>
			<div class="modal-footer"> </div>
		</div>
	</div>
</div> <br><br>
<div class="container">
	<h3>Tops</h3>
	<form action="{{ route ('admin.destroy.top.all')}}" method="POST"> 
        @csrf 
        @method('DELETE')
        <button class="float-right btn btn-danger">Eliminar Todos</button>
    </form> 
    <br> 
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Añafir</button>
	<div class="col-sm col-md-9" style="margin: 0 auto;">
		<table id="table_info" class="table table-striped shadow-lg mt-4">
			<thead class="">
				<tr>
					<th>Top</th>
					<th>Titulo</th>
					<th>Imagen</th>
					<th>Autor</th>
					<th></th>
				</tr>
			</thead>
			<tbody> 
                @foreach ($tops as $top)
				<tr>
					<td>{{$top->posicion}}</td>
					<td>{{$top->audios->titulo}}</td>
					<td> <img src="{{asset($top->audios->imagen)}}" width="120px" alt=""> </td>
					<td>{{$top->audios->autors->autor}}</td>
					<td>
						<form action="{{route('admin.top.update', $top->id)}}" class="form" method="POST"> 
                            @csrf 
                            @method('PUT')
                             <input type="text" id="posicion" name="posicion" class="input" style="width: 60px; border-radius:5px; margin:40px 10px;" value="{{$top->posicion}}"> 
                             <button class="btn btn-primary">Actualiar</button>
                        </form>
						<form action="{{ route ('admin.top.destroy',$top)}}" method="POST"> 
                            @csrf @method('DELETE')
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
<script src="{{asset('js/datatable_init.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
@stop