@extends('layouts.padre') 
@section('title') 
- Audiolibros 
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
          <div class="most-popular" style="background-color: #144272; display: none; margin-top:100px;">
            <div class="row">
              <div class="col-lg-12 col-sm-6">
                <div class="heading-section" style="background-color: #144272;"> <br>
                  <center>
                    <h4>Todos los Audiolibros</h4> </center>
                </div>
                <div class="rom">
                  <form class="" action="{{ route ('portal.search')}}" method="GET">
                    <div class="flex_prueba">
                      <div class="select-box">
                        <div class="options-container"> @foreach ($years as $year)
                          <div class="option"> <input type="radio" class="radio" name="year" id="year" value="{{$year->id}}" /> <label for="film">{{$year->year}}</label> </div> @endforeach </div>
                        <div class="selected"> Año </div>
                      </div>
                      <div class="select-box2">
                        <div class="options-container2"> @foreach ($generos as $genero)
                          <div class="option2"> <input type="radio" class="radio" name="genero" id="genero" value="{{$genero->id}}" /> <label class="texto7" for="film">{{$genero->genero}}</label> </div> @endforeach </div>
                        <div class="selected2"> Genero </div>
                      </div>
                      <div class="select-box3">
                        <div class="options-container3"> @foreach ($autors as $autor)
                          <div class="option3"> <input type="radio" class="radio" name="autor" id="autor" value="{{$autor->id}}" /> <label class="texto7" for="film">{{$autor->autor}}</label> </div> @endforeach </div>
                        <div class="selected3"> Autor </div>
                      </div>
                    </div>
                    <div class="feature-banner header-text">
                      <div class="row">
                        <div class="flex_prueba col-12" style="margin: 0 auto;"> <button class="button_filter" type="submit">
							<img src="{{asset('images/filter.png')}}">
							Filtrar
							</button> </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="container">
                  <div class="row"> 
						@foreach ($audios as $audio)
						<div class="col-lg-3 col-sm-6">
						<div class="item" style="background-color: #0A2647"> <a href="{{ route ('portal.detalles',$audio)}}">
							<img src="{{asset($audio->imagen)}}" alt="">
							<div class="row">
								<div class="col-sm col-md-12" >
								<h4>{{$audio->titulo}}<br></h4>
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
                <div class="col-lg-12" style="margin: 0 auto"> {{ $audios->links('pagination::bootstrap-4')}} </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <br><br> 
@endsection 

@section('js_padre')
<script src="{{asset('js/select.js')}}"></script> 
@endsection