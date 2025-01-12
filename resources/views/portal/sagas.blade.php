@extends('layouts.padre')


@section('title') 
- Sagas
@endsection


@section('css_vista')
<link rel="stylesheet" href="{{asset('css/card_saga_2.css')}}">
@endsection


@section('contenido')
<div class="container" style="display: none;  max-width: 1300px;">
	<div class="row">
		<div class="col-sm col-md-12">
			<div class="row">
				<div class="col-lg-12">
					<div class="page-content" style="background-color: #0A2647">
						<!-- ***** Featured Start ***** -->
						<div class="row">
							<div class="most-popular" style="background-color: #0A2647; display: none;  margin: 0 auto">
								<div class="flex_prueba" style="margin: 0 auto;">
									<h4>Colecciones</h4> </div> <br> 
                </div>
                <div class="feature-banner header-text">
                  <div class="row">
                      <div class="most-popular col-lg-12" style="background-color:#0A2647">
                          <div class="row">
                              @foreach ($sagas as $saga)
                              <div class="col-6 col-lg-2"> <!-- Cada saga ocupará 2 columnas en dispositivos grandes -->
                                <div class="card_saga">
                                  <a href="{{ route ('portal.sagas.view',$saga->nombre)}}" >
                                      <img src="{{asset($saga->imagen)}}" class="card__img">
                                      <span class="card__footer">
                                          <span>{{$saga->nombre}}</span>
                                      </span>
                                  </a>
                                </div>
                              </div>
                              @endforeach
                          </div>
                      </div>
                      <!-- ***** Most Popular End ***** -->
                      <div class="col-lg-6 col-12">
                          <div style="margin: 0 auto">{{ $sagas->links('pagination::bootstrap-4')}}</div>
                      </div>
                  </div>
              </div>
              
              
						</div>
						<!-- ***** Featured End ***** -->
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


