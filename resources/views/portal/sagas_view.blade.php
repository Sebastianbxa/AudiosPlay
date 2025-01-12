@extends('layouts.padre')

@section('title') 
- {{$sagas_views[0]->sagas->nombre}}
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
					<div class="page-content" style="background-color: #0A2647">
						<!-- ***** Featured Start ***** -->
						<div class="row">
							<div class="most-popular" style="background-color: #0A2647; display: none;  margin: 0 auto">
								<div class="flex_prueba" style="margin: 0 auto;">
									<h4>{{$sagas_views[0]->sagas->nombre}} </h4> </div> <br> 
                </div>
                  <div class="feature-banner header-text">
                    <div class="row">
                      <div class="most-popular" style="background-color:#0A2647 ">
                        <div class="row"> 
                          @foreach ($sagas_views as $sagas_view)
                          <div class="col-lg-3 col-sm-6">
                            <div class="item" style="background-color: #0A2647"> <a href="{{ route ('portal.detalles',$sagas_view->audios->slug)}}">
                              <img src="{{asset($sagas_view->audios->imagen)}}" alt="">
                              <h4>{{$sagas_view->audios->titulo}}<br>
                              </a> </div>
                          </div> 
                          @endforeach 
                        </div>
                      </div>
                      <!-- ***** Most Popular End ***** --><br><br> <br><br> 
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

