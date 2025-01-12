
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/form_register_audio.css')}}">
@stop

@section('content')

<br><br>
<div class="container">
	<form action="{{route('admin.etiquetas.store')}}" class="form" method="POST">
         @csrf 
         <span class="title">Etiquetas</span>
		<div class="row"> 
            <input type="text" class="input" name="genero" id="genero" placeholder="Genero"> 
            <input type="text" class="input" name="autor" id="autor" placeholder="Autor"> 
            <input type="text" class="input" name="year" id="year" placeholder="Año"> 
            <input type="text" class="input" name="calificacion" id="calificacion" placeholder="Calificacion">
             <button type="submit">Crear</button> 
            </div>
	</form><br><br>
</div>
<div class="container" style="margin: 0 auto;">
	<div class="row">
		<div class="col-sm col-md-3">
			<div class="container">
				<div class="col-sm col-md-3">
					<table  class="table table-striped shadow-lg mt-4">
						<thead class="">
							<tr>
								<th>Genero</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody> 
                            @foreach ($etiquetas as $etiqueta)
							<tr>
								<td>{{$etiqueta->genero}}</td>
								<td> <a href="{{route('admin.update.genero',$etiqueta)}}" class="btn btn-info">Editar</a> </td>
							</tr> 
                            @endforeach 
                        </tbody>
					</table>
				</div>
			</div> <br><br><br> </div>
		<div class="col-sm col-md-3">
			<div class="col-sm col-md-3">
				<table  class="table table-striped shadow-lg mt-4">
					<thead class="">
						<tr>
							<th>Autor</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody> 
                        @foreach ($autors as $autor)
						<tr>
							<td>{{$autor->autor}}</td>
							<td> <a href="{{route('admin.update.autor',$autor)}}" class="btn btn-info">Editar</a> </td>
						</tr> 
                        @endforeach 
                    </tbody>
				</table>
			</div> <br><br><br> </div>
		<div class="col-sm col-md-3">
			<div class="col-sm col-md-3">
				<table  class="table table-striped shadow-lg mt-4">
					<thead class="">
						<tr>
							<th>Año</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody> 
                        @foreach ($years as $year)
						<tr>
							<td>{{$year->year}}</td>
							<td> <a href="{{route('admin.update.year',$year)}}" class="btn btn-info">Editar</a> </td>
						</tr> 
                        @endforeach 
                    </tbody>
				</table>
			</div> <br><br><br> </div>
		<div class="col-sm col-md-3">
			<div class="col-sm col-md-3">
				<table  class="table table-striped shadow-lg mt-4">
					<thead class="">
						<tr>
							<th>Calificacion</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody> @foreach ($calificacions as $calificacion)
						<tr>
							<td>{{$calificacion->calificacion}}</td>
							<td> <a href="{{route('admin.update.calificacion',$calificacion)}}" class="btn btn-info">Editar</a> </td>
						</tr> @endforeach </tbody>
				</table>
			</div> <br><br><br> </div>
	</div>
</div>


      
@stop



@section('js')
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>

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