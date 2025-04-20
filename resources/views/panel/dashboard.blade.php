
@extends('adminlte::page')

@section('title', 'AudiosApp')

@section('content_header')
@stop

@section('css')
<link rel="stylesheet" href="{{asset('css/card_dashboard.css')}}">
<!-- Boxicons CDN Link -->
<link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop


@section('content')
<br>
<div class="overview-boxes">
	<div class="box">
	  <div class="right-side2">
		<div class="box-topic">Audiolibros</div>
		<div class="number">{{count($audios)}}</div>
		<div class="indicator ">
			<a href="/panel">
			<span style="color: rgba(185, 180, 180, 0.959)">Ver mas</span>
			</a>
		</div>
	  </div>
	  <i class="fa-solid fa-headphones cart"></i>
	</div>
	<div class="box">
	  <div class="right-side">
		<div class="box-topic">Usuarios</div>
		<div class="number">{{count($usuarios)}}</div>
		<div class="indicator">
			<a href="/admin/users">
			<span style="color: rgba(185, 180, 180, 0.959)">Ver mas</span>
			</a>
		</div>
	  </div>
	  <i class="fa-solid fa-user cart"></i>
	</div>
	<div class="box">
	  <div class="right-side">
		<div class="box-topic">Peticiones</div>
		<div class="number">{{count($peticiones)}}</div>
		<div class="indicator">
			<a href="/panel/peticiones/all">
			<span style="color: rgba(185, 180, 180, 0.959)">Ver mas</span>
			</a>
		</div>
	  </div>
	  <i class="fa-regular fa-note-sticky cart"></i>
	</div>
	<div class="box">
	  <div class="right-side">
		<div class="box-topic">Reportes</div>
		<div class="number">{{count($reportes)}}</div>
		<div class="indicator">
			<a href="/panel/reportes/all">
			<span style="color: rgba(185, 180, 180, 0.959)">Ver mas</span>
			</a>
		</div>
	  </div>
	  <i class="fa-solid fa-circle-exclamation cart"></i>
	</div>

	<div class="box">
		<div class="right-side">
		  <div class="box-topic">Visitas</div>
		  <div class="number">{{ $visitasTotales }}</div>
		  <div class="indicator">
			  <span style="color: rgba(185, 180, 180, 0.959)">
				  Hoy: {{ $visitasHoy }}
			  </span>
		  </div>
		</div>
		<i class="fa-solid fa-chart-line cart"></i>
	  </div>
  </div>

  <div class="container mt-6">
	<div class="mb-4 mt-5">
        <h3 class="fw-bold border-bottom pb-2">Auditoría</h3>
    </div>
	<div class="row mb-4">
		<!-- Card de registros hoy -->
		<div class="col-md-6">
			<div class="card shadow border-0 text-white bg-gradient" style="background: linear-gradient(135deg, #4e73df, #224abe);">
				<div class="card-body d-flex align-items-center justify-content-between">
					<div>
						<h6 class="text-uppercase mb-1">Registros Hoy</h6>
						<h2 class="fw-bold">{{ $registroHoy }}</h2>
					</div>
					<div>
						<i class="bi bi-calendar-day fs-1"></i>
					</div>
				</div>
			</div>
		</div>
	
		<!-- Card de registros totales -->
		<div class="col-md-6">
			<div class="card shadow border-0 text-white bg-gradient" style="background: linear-gradient(135deg, #1cc88a, #17a673);">
				<div class="card-body d-flex align-items-center justify-content-between">
					<div>
						<h6 class="text-uppercase mb-1">Registros Totales</h6>
						<h2 class="fw-bold">{{ $registrosTotales }}</h2>
					</div>
					<div>
						<i class="bi bi-bar-chart-line fs-1"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	

    <!-- Card para la tabla de auditoría -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Registros</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>IP</th>
                            <th>URL</th>
                            <th>Método</th>
                            <th>Referer</th>
                            <th>User Agent</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($auditorias as $auditoria)
                            <tr>
                                <td>{{ $auditoria->ip }}</td>
                                <td>{{ Str::limit($auditoria->url, 50) }}</td>
                                <td><span class="badge bg-info text-dark">{{ $auditoria->method }}</span></td>
                                <td>{{ Str::limit($auditoria->referer, 40) }}</td>
                                <td>{{ Str::limit($auditoria->user_agent, 50) }}</td>
                                <td>{{ $auditoria->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-3">
                {{ $auditorias->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>




@stop


@section('js')    
@stop