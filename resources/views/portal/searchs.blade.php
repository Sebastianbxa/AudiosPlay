@extends('layouts.padre')


@section('title') 
- Resultados de Busqueda
@endsection

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/card_poster.css')}}">
<link rel="stylesheet" href="{{asset('css/select.css')}}">
<link rel="stylesheet" href="{{asset('css/button_filter.css')}}">
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
									<h4>Resultados de Busqueda:</h4> </div>
								<div class="text-center">
									<p style="font-size: 20px;">{{Request::get('search')}}</p>
								</div>
							</div>
							<form class="" action="{{ route ('portal.search')}}" method="GET">
								<div class="flex_prueba">
									<div class="select-box">
										<div class="options-container"> 
											@foreach ($years as $year)
											<div class="option"> <input type="radio" class="radio" name="year" id="year" value="{{$year->id}}" /> <label for="film">{{$year->year}}</label> </div> 
											@endforeach 
										</div>
										<div class="selected"> Año </div>
									</div> {{-- 2 box --}}
									<div class="select-box2">
										<div class="options-container2"> 
											@foreach ($generos as $genero)
											<div class="option2"> <input type="radio" class="radio" name="genero" id="genero" value="{{$genero->id}}" /> <label class="texto7" for="film">{{$genero->genero}}</label> </div> 
											@endforeach
										 </div>
										<div class="selected2"> Genero </div>
									</div> {{-- 3 box --}}
									<div class="select-box3">
										<div class="options-container3"> 
											@foreach ($autors as $autor)
											<div class="option3"> <input type="radio" class="radio" name="autor" id="autor" value="{{$autor->id}}" /> <label class="texto7" for="film">{{$autor->autor}}</label> </div> 
											@endforeach 
										</div>
										<div class="selected3"> Autor </div>
									</div>
								</div>
								<div class="feature-banner header-text">
									<div class="row">
										<div class="flex_prueba col-12" style="margin: 0 auto;"> <button class="button_filter" type="submit">
												<img src="{{asset('images/filter.png')}}">
												Filtrar
											</button> 
										</div>
									</div>
								</div>
							</form>
						</div>
							<div class="most-popular" style="background-color:#144272 ">
								<div class="row"> 
									@forelse ($searchAudios as $searchAudio)
									<div class="col-lg-3 col-sm-6">
										<div class="item" style="background-color: #0A2647"> <a href="{{ route ('portal.detalles',$searchAudio)}}">
                                            <img src="{{asset($searchAudio->imagen)}}" alt="">
                                          
                                            <h4>{{$searchAudio->titulo}}<br>
                                            </a>
											<a href="{{ route ('portal.autor',$searchAudio->autors->autor)}}"> <span>{{$searchAudio->autors->autor}}</span></h4>
											</a>
											<a href="{{ route ('portal.genero',$searchAudio->generos->genero)}}"> <span>{{$searchAudio->generos->genero}}</span></h4>
											</a> <span>{{$searchAudio->years->year}}</span></h4>
											<div class="texto-encima3"> <span style="color: #ffffff"><i class="fa fa-star" style="color: #f7f406;"></i>{{$searchAudio->calificacions->calificacion}}</span> </div>
										</div>
									</div> 
									@empty
									<div class="col-md-12 p-2" style="margin-top: 50px;">
										<div class="mx-auto col-md-5 text-center">
											<p style="font-size: 25px;">Lo sentimos, no hay resultados que coincidan con tu búsqueda.</p>
										</div>
									</div> 
									@endforelse 
								</div>
							</div><br><br>
							<div style="margin: 0 auto"> {{ $searchAudios->appends(request()->input())->links('pagination::bootstrap-4')}} </div> <br><br> 
					</div>
				</div>
			</div>			
		</div>
	</div>
</div><br><br>
@endsection



@section('js_padre')
<script src="{{asset('js/select.js')}}"></script>
@endsection

