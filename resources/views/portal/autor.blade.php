@extends('layouts.padre')

@section('title') 
- {{$searchAudios[0]->autors->autor}}
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
							<div class="col-lg-12">
								<div class="feature-banner header-text">
									<div class="most-popular" style="background-color: #144272; display: none;  margin: 0 auto">
										<div class="flex_prueba" style="margin: 0 auto;">
											<h4>{{$searchAudios[0]->autors->autor}}</h4> </div> <br> </div>
                        <div class="most-popular" style="background-color:#144272 ">
                          <div class="row"> 
                            @foreach ($searchAudios as $searchAudio)
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
                            @endforeach 
                          </div>
                        </div>
					           <br><br>
										<div style="margin: 0 auto"> {{ $searchAudios->links('pagination::bootstrap-4')}} </div> <br><br> </div>
								</div>
							</div>
					</div><!-- ***** Featured End ***** -->
				</div>
			</div>
		</div>
	</div>
</div><br><br>
@endsection


@section('js_padre')
<script src="{{asset('js/select.js')}}"></script>
@endsection
