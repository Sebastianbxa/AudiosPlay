@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')


<style>
    .configuracion-software-container {
        margin-top: 2rem; /* Espacio superior */
    }
    .card-configuracion {
        padding: 2rem;
        border-radius: 0.5rem;
    }
    .btn-crear-ajustes {
        background-color: #28a745;
        color: #fff;
        font-weight: 600;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-crear-ajustes:hover {
        background-color: #218838;
        color: #fff;
    }
</style>
@stop

@section('content')

<div class="container configuracion-software-container">
    <div class="card shadow-lg card-configuracion">
        <h2>Configuración del Software</h2>

        <!-- Mostrar botón "Crear Ajustes" solo si no hay ajustes -->
        @if ($ajustes->isEmpty())
        <button type="button" class="btn btn-crear-ajustes mt-3" data-toggle="modal" data-target="#ajustesModal">
            Crear Ajustes
        </button>
        @endif
    </div>

    <!-- Modal para Crear Ajustes -->
    <div class="modal fade" id="ajustesModal" tabindex="-1" aria-labelledby="ajustesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajustesModalLabel">Configuración del Software</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.ajustes.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <input type="text" class="form-control" name="nombre_software" placeholder="Nombre del Software" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Membresía</h4>
								<input type="number" class="form-control mb-2" name="precio_membresia" step="0.01" placeholder="Precio Membresía" required>
                            	<textarea class="form-control" name="precio_membresia_descripcion" placeholder="Tipo de Moneda"></textarea>
                            </div>
                            <div class="col-md-6">
                                <h4>Redes Sociales</h4>
                                <input type="text" class="form-control mb-2" name="whatsapp" placeholder="WhatsApp">
                                <input type="text" class="form-control mb-2" name="telegram" placeholder="Telegram">
                                <input type="text" class="form-control mb-2" name="discord" placeholder="Discord">
                            </div>
                        </div>
                        <div class="mb-4">
                            <h4>Métodos de Pago</h4>
							<p>Resolución 512x512</p>
							<input type="text" class="form-control mb-2" name="metodo_pago_1" placeholder="Numero de Cuenta - Método de Pago 1">
							<input type="file" class="form-control mb-3" name="imagen_metodo_pago_1">
							<input type="text" class="form-control mb-2" name="metodo_pago_2" placeholder="Numero de Cuenta - Método de Pago 2">
							<input type="file" class="form-control mb-3" name="imagen_metodo_pago_2">
							<input type="text" class="form-control mb-2" name="metodo_pago_3" placeholder="Numero de Cuenta - Método de Pago 3">
							<input type="file" class="form-control mb-3" name="imagen_metodo_pago_3">
							<input type="text" class="form-control mb-2" name="metodo_pago_4" placeholder="Numero de Cuenta - Método de Pago 4">
							<input type="file" class="form-control mb-4" name="imagen_metodo_pago_4">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección para listar ajustes existentes -->
    <div class="container mt-5 mb-4">
        @foreach ($ajustes as $ajuste)
		<div class="card mb-3 shadow-lg">
			<div class="card-header bg-primary text-white">
				<h5 class="card-title mb-0">{{ $ajuste->nombre_software ?? 'Configuración del Software' }}</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<!-- Membresía -->
					<div class="col-md-4 mb-4">
						<h6 class="text-muted">Membresía</h6>
						<div class="d-flex align-items-center border-bottom pb-3 mb-3">
							<i class="fas fa-dollar-sign fa-2x text-black me-4"></i>
							<p class="mb-0"><strong>Precio:</strong> 
								<span class="text-dark">{{ $ajuste->precio_membresia ? '$' . number_format($ajuste->precio_membresia, 2) : 'No especificado' }}</span>
							</p>
						</div>
						<div class="d-flex align-items-center border-bottom pb-3 mb-3">
							<i class="fas fa-file-alt fa-2x text-black me-4"></i>
							<p class="mb-0"><strong>Descripción:</strong> 
								<span class="text-dark">{{ $ajuste->precio_membresia_descripcion ?? 'No especificado' }}</span>
							</p>
						</div>
					</div>
		
					<!-- Redes Sociales -->
					<div class="col-md-4 mb-4">
						<h6 class="text-muted">Redes Sociales</h6>
						<div class="d-flex align-items-center border-bottom pb-3 mb-3">
							<i class="fab fa-whatsapp fa-2x text-black me-4"></i>
							<p class="mb-0"><strong>WhatsApp:</strong> 
								<span class="text-dark">{{ $ajuste->whatsapp ?? 'No especificado' }}</span>
							</p>
						</div>
						<div class="d-flex align-items-center border-bottom pb-3 mb-3">
							<i class="fab fa-telegram fa-2x text-black me-4"></i>
							<p class="mb-0"><strong>Telegram:</strong> 
								<span class="text-dark">{{ $ajuste->telegram ?? 'No especificado' }}</span>
							</p>
						</div>
						<div class="d-flex align-items-center border-bottom pb-3 mb-3">
							<i class="fab fa-discord fa-2x text-black me-4"></i>
							<p class="mb-0"><strong>Discord:</strong> 
								<span class="text-dark">{{ $ajuste->discord ?? 'No especificado' }}</span>
							</p>
						</div>
					</div>
		
					<!-- Métodos de Pago -->
					<div class="col-md-4 mb-4">
						<h6 class="text-muted">Métodos de Pago</h6>
						@for ($i = 1; $i <= 4; $i++)
							@if (!empty($ajuste->{'metodo_pago_'.$i}))
							<div class="d-flex align-items-center border-bottom pb-3 mb-3">
								<i class="fas fa-credit-card fa-2x text-black me-4"></i>
								<p class="mb-0"><strong>Método {{ $i }}:</strong> 
									<span class="text-dark">{{ $ajuste->{'metodo_pago_'.$i} }}</span>
								</p>
							</div>
							@if (!empty($ajuste->{'imagen_metodo_pago_'.$i}))
							<div class="text-center mb-3">
								<img src="{{ asset($ajuste->{'imagen_metodo_pago_'.$i}) }}" alt="Imagen Método {{ $i }}" class="img-fluid rounded shadow-sm" style="max-width: 100px;">
							</div>
							@else
							<p class="text-muted text-center">Sin imagen asociada.</p>
							@endif
							@endif
						@endfor
					</div>
				</div>
		
				<!-- Botón para actualizar -->
				<div class="text-center mt-4">
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal-{{ $ajuste->id }}">
						Actualizar Ajustes
					</button>
				</div>
			</div>
		</div>
		


        <!-- Modal para Actualizar Ajustes -->
        <div class="modal fade" id="updateModal-{{ $ajuste->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Actualizar Ajustes</h5>
                        
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.ajustes.update', $ajuste) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <h4>Configuración del Software</h4>
                                <input type="text" class="form-control" name="nombre_software" value="{{ $ajuste->nombre_software }}" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Membresia</h4>
									<input type="number" class="form-control mb-2" name="precio_membresia" value="{{ $ajuste->precio_membresia }}" step="0.01" required>
									<textarea class="form-control" name="precio_membresia_descripcion">{{ $ajuste->precio_membresia_descripcion }}</textarea>
                                   
                                </div>
                                <div class="col-md-6">
                                    <h4>Redes Sociales</h4>
                                    <input type="text" class="form-control mb-2" name="whatsapp" value="{{ $ajuste->whatsapp }}">
                                    <input type="text" class="form-control mb-2" name="telegram" value="{{ $ajuste->telegram }}">
                                    <input type="text" class="form-control mb-2" name="discord" value="{{ $ajuste->discord }}">
                                </div>
                            </div>
                            <div class="mb-4">
                                <h4>Metodos de Pago</h4>
								<input type="text" class="form-control mb-2" name="metodo_pago_1" value="{{ $ajuste->metodo_pago_1 }}">
								<input type="file" class="form-control mb-2" name="imagen_metodo_pago_1">
								<input type="text" class="form-control mb-2" name="metodo_pago_2" value="{{ $ajuste->metodo_pago_2 }}">
								<input type="file" class="form-control mb-2" name="imagen_metodo_pago_2">
								<input type="text" class="form-control mb-2" name="metodo_pago_3" value="{{ $ajuste->metodo_pago_3 }}">
								<input type="file" class="form-control mb-2" name="imagen_metodo_pago_3">
								<input type="text" class="form-control mb-2" name="metodo_pago_4" value="{{ $ajuste->metodo_pago_4 }}">
								<input type="file" class="form-control mb-2" name="imagen_metodo_pago_4">
                               
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

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
        '¡Eliminado!',
        'El ajuste ha sido eliminado.',
        'success'
    )
</script>
@endif
@stop
