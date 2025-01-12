@extends('layouts.padre')

@section('title') 
- Enlaces VIP
@endsection

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/card_mesege.css')}}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,700;1,400&display=swap" rel="stylesheet">

<style>
  .flex_prueba{
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
 justify-content: center;
 
}
</style>
@endsection



@section('contenido')
<div class="container" style="display: none;">
	<div class="row">
		<div class="col-sm col-md-12">
			<div class="row">
				<div class="col-lg-12">
					<div class="page-content" style="background-color: #0A2647">
						<!-- ***** Featured Start ***** -->
						<div class="row">
							<div class="col-lg-12">
								<div class="feature-banner header-text">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-md-12" style="margin-top: 20px; text-align: center; margin-bottom:20px;">
											<h3>{{$audio->titulo}}</h3><strong>
                        <img src="{{asset($audio->imagen)}}" alt="" style="border-radius: 23px; margin-top: 20px; margin-bottom:10px; height: 400px; width:400px">
                            <br><br><h4>Enlaces VIP</h4>
                          </strong> </div>
                            <div class="most-popular col-md-12" style="background-color:#0A2647;">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="row">
                                    <div class="col-12">
                                      <h4>Servidor 1</h4> <br> </div> {{-- Card Nota Importante --}}
                                    <div class="alert_card success-alert" style="margin: 0 0; margin-bottom:30px;"> <a href="{{$audio->download_1}}" target="_blank" style="font-size: 25px;">Ir al enlace</a> </div> <br><br>
                                    <div class="col-12">
                                      <h4>Servidor 2</h4> <br> </div>
                                    <div class="alert_card success-alert" style="margin: 0 0; margin-bottom:30px;">
                                      <div> <a href="{{$audio->download_2}}" target="_blank" style="font-size: 25px;">Ir al enlace</a> </div>
                                    </div> <br><br> </div>
                                </div>
                              </div>
                            </div>
                    <br><br><br><br> 
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
</div>
@endsection
