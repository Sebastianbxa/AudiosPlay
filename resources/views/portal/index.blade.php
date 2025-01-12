@extends('layouts.padre') 

@section('title') 
- Audiolibros de Calidad
@endsection

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/card_poster.css')}}">
<link rel="stylesheet" href="{{asset('css/button_tags.css')}}"> 
@endsection

@section('contenido')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="page-content" style="padding: 0px 2px">
				<!-- ***** Banner Start ***** -->
				<div class="main-banner" style="display: none;">
					<div class="row">
						<div class="col-lg-12">
							<div class="header-text"> 
              				</div>
						</div>
					</div>
				</div>
				<!-- ***** Banner End ***** -->
				<!-- ***** Featured Games Start ***** -->
				<div class="container" style="margin-top: 5%; display:none;">
					<div class="row">
						<div class="col-lg-8">
							<div class="featured-games header-text" style="background-color: #144272">
								<div class="heading-section" style="background-color: #144272">
									<h4><em>Nuevos</em></h4> </div>
								<div class="owl-features owl-carousel"> 
									@foreach ($nuevos as $nuevo)
										<div class="item">
											<div class="thumb"> <a href="{{ route ('portal.detalles',$nuevo->audios)}}">
											<img src="{{asset($nuevo->audios->imagen)}}" alt="">
											</div>
											<h4>{{$nuevo->audios->titulo}}<br><span>{{$nuevo->audios->autors->autor}}</span></h4>
											</a>
											
										</div> 
									@endforeach 
                  				</div>
							</div>
						</div>
							<div class="col-lg-4">
								<div class="top-downloaded" style="background-color: #144272;display:none;">
									<div class="heading-section">
										<h5><em>Recomendados</em></h5> <br> </div>
										<ul> 
											@foreach ($recomendados as $recomendado) 
											<li> 
												<a href="{{ route ('portal.detalles',$recomendado->audios)}}">
												<img src="{{asset($recomendado->audios->imagen)}}" alt="" class="templatemo-item">
												<h4>{{$recomendado->audios->titulo}}</h4>
												</a>
												<h6 class="texto1">{{$recomendado->audios->autors->autor}}</h6> <span><i class="" style="color: #ffffff;"></i> {{$recomendado->audios->generos->genero}}</span> <span><i class="fa fa-star" style="color: rgb(255, 255, 255);"></i>{{$recomendado->audios->calificacions->calificacion}}</span> 
											</li> 
											@endforeach 
										</ul>
									<div class="text-button" style="color:#ffffff"> <a href="{{ route ('portal.sugeridos')}}">Ver Mas</a> </div>
								</div>
							</div>
						</div>
					</div>
				  <br><br>
					<!-- ***** Most Popular Start ***** -->
					<div class="most-popular" style="background-color: #144272; display: none;  margin: 0 auto">
						<div style="display: flex; justify-content: center;">
							<h4>Buscar</h4> </div> <br>
						<div class="flex_prueba"> <a class="button_tags" href="/audiolibros">Autor</a> <a class="button_tags" href="/audiolibros">Genero</a> <a class="button_tags" href="/audiolibros">Año</a> <a class="button_tags" href="/sagas">Saga</a> <a class="button_tags" href="/top">Top</a> <a class="button_tags" href="/sugeridos">Sugeridos</a> </div> <br><br> 
					</div>
			</div> <br><br>
				<div class="most-popular" style="background-color: #144272; display: none;">
					<div class="row">
						<div class="col-lg-12 col-sm-6">
							<div class="heading-section" style="background-color: #144272;"> <br>
								<center>
								<h4>Audiolibros Recientes</h4> 
								</center>
							</div>
							<div class="container" style="padding: 20px;">
								<div class="row"> 
									@foreach ($audios as $audio)
										<div class="col-lg-3 col-sm-6">
										<div class="item" style="background-color: #0A2647"> <a href="{{ route ('portal.detalles',$audio)}}">
											<img src="{{asset($audio->imagen)}}" alt="">
											<div class="row">
												<div class="col-sm col-md-12" >
												<h4>{!! Str::limit($audio->titulo, 24) !!} <br></h4>
												</div>
											</div>	
											</a>
											<div class="col-sm col-md-12">
											<a href="{{ route ('portal.autor',$audio->autors->autor)}}"> <span>{{$audio->autors->autor}}</span> </a>
											<a href="{{ route ('portal.genero',$audio->generos->genero)}}"> <span>  {!! Str::limit($audio->generos->genero, 23) !!}</span> </a>
											</div>
											<div class="texto-encima3"> <span style="color: #ffffff"><i class="fa fa-star" style="color: rgb(255, 255, 255);"></i>{{$audio->calificacions->calificacion}}</span> </div>
										</div>
										</div>
									@endforeach
								</div>
									
							</div>
							<div class="col-lg-12"> <br>
								<div class="main-button"> <a href="/audiolibros/?page=2">Ver audiolibros</a> </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><br><br><br>
@endsection
