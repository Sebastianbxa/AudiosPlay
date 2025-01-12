@extends('layouts.padre')

@section('title') 
- Sugeridos
@endsection

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/card_poster.css')}}">
@endsection




@section('contenido')
<div class="container" style="display: none;  max-width: 1300px;">
	<div class="row">
		<div class="col-sm col-md-12">
			<div class="row">
				<div class="col-lg-12">
					<div class="page-content" style="background-color: #144272">
						<!-- ***** Featured Start ***** -->
						<div class="row">
							<div class="most-popular" style="background-color: #144272; display: none;  margin: 0 auto">
								<div class="flex_prueba" style="margin: 0 auto;">
									<h4>Audiolibros Recomendados</h4> 
								</div> <br> </div>
						</div>
						<div class="feature-banner header-text">
							<div class="row">
								<div class="most-popular" style="background-color:#144272 ">
									<div class="row"> 
                   						 @foreach ($tops as $top)
											<div class="col-lg-3 col-sm-6">
												<div class="item" style="background-color: #0A2647"> <a href="{{ route ('portal.detalles',$top)}}">
												<img src="{{asset($top->imagen)}}" alt=""> 
												<h4>{{$top->titulo}}<br>
												</a>
													<a href="{{ route ('portal.autor',$top->autors->autor)}}"> <span>{{$top->autors->autor}}</span></h4>
													</a>
													<a href="{{ route ('portal.genero',$top->generos->genero)}}"> <span>{{$top->generos->genero}}</span></h4>
													</a>
													<div class="texto-encima3"> <span style="color: #ffffff"><i class="fa fa-star" style="color: #f7f406;"></i>{{$top->calificacions->calificacion}}</span> </div>
												</div>
											</div> 
                    					@endforeach 
                 					</div>
								</div><br><br> <br><br> 
							</div>
						</div>
					</div>
					<!-- ***** Featured End ***** -->
				</div>
			</div>
		</div>
	</div>
</div><br><br>
@endsection




      
