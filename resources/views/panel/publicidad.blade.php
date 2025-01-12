
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
<link rel="stylesheet" href="{{asset('css/form_register_audio.css')}}">
<link rel="stylesheet" href="{{asset('css/input_file.css')}}">
@stop

@section('content')

<br><br>
<div class="container">
	<form action="{{route('admin.publicidad.store')}}" class="form" method="POST" enctype="multipart/form-data"> @csrf <span class="title">Nueva Publicidad</span>
		<div class="row">
			<div class="col-sm col-md-12">
                <input type="file" name="imagen" id="imagen" class="input">
				<select class="input" name="codigo" id="codigo" required>
					<option value="">Seleccione la ubicacion de la publicidad</option>
					<option value="Banner">Banner</option>
					<option value="MiniBanner">Mini-Banner</option>
				  </select>  
                <input type="text" class="input" name="link" id="link" placeholder="Link"> 
                <button type="submit">Crear</button> 
            </div>
		</div>
	</form> <br><br> 
</div>
<div class="container">
	<div class="col-sm col-md-10" style="margin: 0 auto;">
		<table id="table_info" class="table table-striped shadow-lg mt-4">
			<thead class="">
				<tr>
					<th>Imagen</th>
					<th>Ubicacion</th>
					<th>Link</th>
					<th>Visitas</th>
					<th></th>
				</tr>
			</thead>
			<tbody> 
                @foreach ($publicidad as $publicida)
				<tr>
					<td> <img src="{{asset($publicida->imagen)}}" width="120px" alt=""> </td>
					<td>{{$publicida->codigo}}</td>
					<td>{{$publicida->link}}</td>
					<td>{{$publicida->view}}</td>
					<td>
						<form action="{{ route ('admin.publicidad.destroy',$publicida)}}" method="POST"> 
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
<script src="{{asset('js/datatable_init.js')}}"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>    

@if (session('eliminar') == 'ok')
    <script>
    Swal.fire(
            '¡Guardado!',
            'Publicidad Creada',
            'success'
            )

    </script>
@endif

    
@stop