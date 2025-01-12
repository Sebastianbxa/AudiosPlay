@extends('layouts.padre')

@section('title') 
- {{$audio->titulo}}
@endsection  

@section('css_vista')
<link rel="stylesheet" href="{{asset('css/card_poster.css')}}">
<link rel="stylesheet" href="{{asset('css/accordeon.css')}}">
<link rel="stylesheet" href="{{asset('css/tabs.css')}}">
<link rel="stylesheet" href="{{asset('css/form_reportar.css')}}">
<link rel="stylesheet" href="{{asset('css/button_tags.css')}}">
<link rel="stylesheet" href="{{asset('css/comment.css')}}">
<link rel="stylesheet" href="{{asset('css/comment_input.css')}}">
<link rel="stylesheet" href="{{asset('css/card_mesege.css')}}">
<link rel="stylesheet" href="{{asset('css/card_social.css')}}">
<link rel="stylesheet" href="{{asset('css/favoritie.css')}}">
<link rel="stylesheet" href="{{asset('css/card_download_3.css')}}">
  
{{--Preloader Comentarios --}}
<link rel="stylesheet" href="{{asset('css/preloader_pure.css')}}">

{{---Sweet Alert---}}
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
<link rel="stylesheet" href="{{asset('css/settings.css')}}">


{{---Player ---}}
<link rel="stylesheet" href="{{asset('css/player.css')}}">
<link rel='stylesheet' href='https://icono-49d6.kxcdn.com/icono.min.css'>



<style>
@media (max-width: 768px) {
    /* Styles for screens with a maximum width of 768px */
    .mobile-only {
        display: block;
    }
    .desktop-only {
        display: none;
    }

    .mobile-only2 {
      display: block;
      width: 100%; /* Cambia esto al tamaño deseado */
      overflow: hidden;
    }
    .mobile-only2 img {
      width: 100%;
      height: 113px;
      /* transform: scale(1.6); */
      transform: scaleX(2.1) scaleY(0.7);
  }

    }


@media (min-width: 769px) {
    /* Styles for screens with a minimum width of 769px (desktop) */
    .mobile-only {
        display: none;
    }

    .mobile-only2 {
        display: none;
    }

    .desktop-only {
        display: block;
    }

}
</style>
@endsection

@section('contenido')
<div class="container" style="display: none;">
  <div class="row">
   <div class="col-sm col-md-8">
    <div class="row">
     <div class="col-lg-12">
      <div class="page-content" style="background-color: #144272">
       <!-- ***** Featured Start ***** -->
       <div class="row">
        <div class="col-lg-12">
         <div class="feature-banner header-text">
          <div class="row">
           <div class="col-lg-5">
            <div class="card_poster">
             <div class="container"> <img src="{{asset($audio->imagen)}}" alt="" style="border-radius: 23px; margin-top: 20px; margin-bottom:10px;">
              <div class="texto-encima"> <span style="color: #ffffff"><i class="fa fa-star" style="color: rgb(255, 255, 255); "></i>{{$audio->calificacions->calificacion}}</span> </div>
              <p style="color: #ffffff"><i class="fas fa-clock" style="color: #ffffff;"></i> {{$audio->time}}</p>
              <a href="{{ route ('portal.genero',$audio->generos->genero)}}">
               <p style="color: #ffffff"><i class="" style="color: #ffffff;"></i> {{$audio->generos->genero}}</p>
              </a>
              <p style="color: #ffffff"><i class="" style="color: #ffffff;"></i> {{$audio->years->year}}</p>
             </div>
            </div>
           </div>
           <div class="col-lg-7">
            <div class="content">
             <div class="row">
              <div class="col-lg-12">
               <div class="left-info">
                <div class="left"> <br>
                 <h4>{{$audio->titulo}}</h4> </div>
                <div class="texto1">
                 <a href="{{ route ('portal.autor',$audio->autors->autor)}}">
                  <h2>{{$audio->autors->autor}}</h2> </a>
                </div> <br> </div>
              </div>
              <div class="col-lg-12" style="margin-bottom: 15px;">
               <div id="textodescripcion">
                <p> {!! nl2br(e($audio->descripcion)) !!} </p> <span id="text"></span>
                <script>
                 document.getElementById('text').addEventListener('click', function(){
                    // alert('ok')
                    document.getElementById('textodescripcion').classList.toggle('active');
                  });
                </script>
               </div>
              </div>
             </div>
            </div>
           </div><br>
           <div class="containerz">
             <a class="no_guardado" id="heart" onclick="heart_action()"> 
               Guardar
            </a>
           
           </div> <br> 
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div> 
    {{-- ESPACIO PUBLICITARIO --}}
    {{-- @foreach ($publicidad as $publicida)
        @if ($publicida->codigo == "MiniBanner")
         <br><br>
         <div class="mobile-only">
            <div class="mobile-only2">
              <div style="background-color: #0A2647; margin-bottom: -13px;">
                <p>Publicidad</p>
               </div> 
              <a target="_blank" href="{{ route('portal.publicidad', $publicida)}}">
                <img src="{{asset($publicida->imagen)}}" alt="" >
              </a> 
            </div>
          </div>
          <div class="desktop-only">
            <div style="background-color: #0A2647;">
              <p>Publicidad</p>
             </div>    
            <a target="_blank" href="{{ route('portal.publicidad', $publicida)}}">
              <img src="{{asset($publicida->imagen)}}" alt=""  height="86px">
            </a> 
          </div>
        @endif
      @endforeach --}}
    <br>
    <div class="wrapper" style="display: none;">
     <div class="tabs">
      <div class="tab"> <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch"> <label for="tab-1" class="tab-label">Reproducir</label>
       <div class="tab-content" style="width: 100%;">
        
        @if (Auth::check() && $membresia == "Activado")
        <div class="accordion-wrapper">
          @if ($audio->url_a)
         <div class="accordion"> <input type="radio" name="radio-a" id="check1" checked> <label class="accordion-label" for="check1">Opcion 1</label>
          <div class="accordion-content"> 
              <iframe id="audioFrame" width="100%" height="120" src="{{$audio->url_a}}" frameborder="0"></iframe>
              <script>
                const audioFrame = document.getElementById('audioFrame');
                // Función para guardar la posición actual del audio en localStorage
                function guardarPosicionAudio() {
                    try {
                        const iframeContent = audioFrame.contentWindow.document;
                        const audioElement = iframeContent.querySelector('audio');
                        
                        if (audioElement) {
                            const currentPosition = audioElement.currentTime;
                            localStorage.setItem('audioPosition', currentPosition);
                            console.log('Posición actual del audio guardada:', currentPosition);
                        }
                    } catch (error) {
                        console.error('Error al guardar la posición del audio:', error);
                    }
                }
        
                // Función para restaurar la posición guardada del audio desde localStorage
                function restaurarPosicionAudio() {
                    try {
                        const iframeContent = audioFrame.contentWindow.document;
                        const audioElement = iframeContent.querySelector('audio');
                        
                        const savedPosition = localStorage.getItem('audioPosition');
                        if (audioElement && savedPosition !== null) {
                            audioElement.currentTime = parseFloat(savedPosition);
                            console.log('Posición del audio restaurada:', savedPosition);
                        }
                    } catch (error) {
                        console.error('Error al restaurar la posición del audio:', error);
                    }
                }
        
                // Llamada a la función para restaurar la posición al cargar la página
                restaurarPosicionAudio();
        
                // Evento para guardar la posición al salir de la página o al hacer clic en un botón, por ejemplo
                window.addEventListener('beforeunload', guardarPosicionAudio);
                
              </script>
           </div>
         </div> 
         @endif
         
         @if ($audio->url_b)
         <div class="accordion"> <input type="radio" name="radio-a" id="check2"> <label class="accordion-label" for="check2">Opcion 2</label>
          <div class="accordion-content"> {{-- extraer id - recibe js --}}
           <div id="audioUrl" data-url="{{$audio->url_b}}"></div>
           <div class="audio-player">
            <div class="timeline">
             <div class="progress"></div>
            </div>
            <div class="controls">
             <div class="play-container">
              <div class="toggle-play play"> </div>
             </div>
             <div class="time">
              <div class="current">0:00</div>
              <div class="divider">/</div>
              <div class="length"></div>
             </div>
             <div class="name">Onedrive</div>
             <div class="volume-container">
              <div class="volume-button">
               <div class="volume icono-volumeMedium"></div>
              </div>
              <div class="volume-slider">
               <div class="volume-percentage"></div>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div> @endif @if ($audio->url_c)
         <div class="accordion"> <input type="radio" name="radio-a" id="check3"> <label class="accordion-label" for="check3">Opcion 3</label>
          <div class="accordion-content"> {{---Ivox ---}}
           <div id="audioUrlC" data-url="{{$audio->url_c}}"></div>
           <div class="audio-playerc">
            <div class="timelinec">
             <div class="progressc"></div>
            </div>
            <div class="controlsc">
             <div class="play-container">
              <div class="toggle-playc playc"> </div>
             </div>
             <div class="timec">
              <div class="currentc">0:00</div>
              <div class="dividerc">/</div>
              <div class="lengthc"></div>
             </div>
             <div class="name">Ivox</div>
             <div class="volume-container">
              <div class="volume-button">
               <div class="volume icono-volumeMedium"></div>
              </div>
              <div class="volume-sliderc">
               <div class="volume-percentagec"></div>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div> 
         @endif 
        </div>
        @else
          <div class="col-12 text-center">
            <i class="fa-solid fa-crown" style="font-size: 150px; margin-top: 30px; color:#ffffff" ></i>
            <h3 style="font-size: 2.5rem;">Exclusivo Miembros VIP</h3><br>
            <a href="/membresia" type="button" class="btn btn-light btn-lg">Adquirir</a>
          </div>
        @endif
       </div>
      </div>
      <div class="tab" style="display: none;"> <input type="radio" name="css-tabs" id="tab-2" class="tab-switch"> <label for="tab-2" class="tab-label">Descargar</label>
       <div class="tab-content" style="width: 100%;"> {{-- Card Membresia --}}
        @if (Auth::check() && $membresia == "Activado")
            @if ($audio->download_1)
            <div class="courses-container">
              <div class="course">
              <div class="course-preview"><i class="fa-solid fa-download"></i></div>
              <div class="course-info">
                <h2>SERVIDOR 1</h2>
                <a href="{{$audio->download_1}}" target="_blank"> <button class="btn3">Ir al enlace</button> </a>
              </div>
              </div>
            </div>
            @endif
            @if ($audio->download_2)
            <div class="courses-container">
              <div class="course">
              <div class="course-preview"><i class="fa-solid fa-download"></i></div>
              <div class="course-info">
                <h2>SERVIDOR 2</h2>
                <a href="{{$audio->download_2}}" target="_blank"> <button class="btn3">Ir al enlace</button> </a>
              </div>
              </div>
            </div>  
            @endif 
        @else
          <div class="col-12 text-center">
            <i class="fa-solid fa-crown" style="font-size: 150px; margin-top: 30px; color:#ffffff" ></i>
            <h3 style="font-size: 2.5rem;">Exclusivo Miembros VIP</h3><br>
            <a href="/membresia" type="button" class="btn btn-light btn-lg">Adquirir</a>
          </div>
        @endif

       </div>
      </div>
      <div class="tab" style="display: none;"> <input type="radio" name="css-tabs" id="tab-3" class="tab-switch"> <label for="tab-3" class="tab-label">Reportar</label>
       <div class="tab-content" style="width: 100%;">
        @if (Auth::check() && $membresia == "Activado")
          <div class="wrapper3">
          <p>Reporté</p>
          <form class="form_reportar" action="{{route('portal.reporte', $audio->id)}}" method="POST"> @csrf
            <div class="input-box"> <input type="text" name="problema" id="problema" placeholder="¿Cual es el motivo?" required> </div>
            @if (!Auth::check())
            <div class="input-box"> <input class="" type="email" name="correo" id="correo" placeholder="Correo electronico" required> </div>
            @endif
            <div class="input-box button"> <input type="Submit" value="Enviar"> </div>
          </form>
          </div>
        @else
          <div class="col-12 text-center">
            <i class="fa-solid fa-crown" style="font-size: 150px; margin-top: 30px; color:#ffffff" ></i>
            <h3 style="font-size: 2.5rem;">Exclusivo Miembros VIP</h3><br>
            <a href="/membresia" type="button" class="btn btn-light btn-lg">Adquirir</a>
          </div>
          @endif
       </div>
      </div>
     </div>
    </div>
    <div class="most-popular4" style="background-color: #144272;  margin: 0 auto"> <br>
     <div style="display: flex; justify-content: left;">
      <h5>Comentarios</h5> </div> <br> 
      {{-- Input Comentarios --}} 
      @if (Auth::check()) 
      @php 
      $user_name = (auth()->user()->name); $user_id = (auth()->user()->id); 
      @endphp
     <div class="container_coment">
      <div class="wrapper_coment">
       <section class="post">
        <form class="form_comment" id="form_comentar"> @csrf
         <div class="content"> <img src="{{asset('menu/perfil.jpg')}}" alt="logo">
          <div class="details">
           <p>{{$user_name}}</p>
          </div>
         </div> <textarea name="comentario" id="comentario" class="textarea_comment" placeholder="Deja tu comentario..." spellcheck="false" required></textarea> </section>
      </div>
     </div> <button type="submit" id="button_comentar" class="button-18">Comentar</button> </form> 
     @else {{-- Card Nota Importante --}}
     <div class="alert_card success-alert" style="text-align: center;">
      <div>
       <p>Para poder dejar un comentario y entre otras muchas mas funcionabilidades. <br> <a href="/register">Registrate aqui</a> - <strong>¡Es Gratis! </strong></p>
      </div>
     </div> @endif 
     {{-- Comentarios --}} 
     @php use Carbon\Carbon; Carbon::setlocale(config('app.locale')); @endphp
     <div class="central">
      <div id="preloader_two" class="lds-ring">
       <div></div>
       <div></div>
       <div></div>
       <div></div>
      </div>
     </div>
     <div class="comments-container">
      <ul id="nuevo_comentario" class="comments-list elemento-oculto">
        {{--- Comnetarios ajax ---}}
       <div id="formContainer"></div>
      </ul>
      <ul id="lista-comentarios" class="comments-list">
        {{--- Comnetarios ajax ---}} 
       <div id="formContainer"></div>
      </ul>
     </div> <br><br> </div> <br><br> </div> 
     {{--- Termina columna1---}}
   <div class="col-sm col-md-4">
    <div class="div4" >
      <div class="most-popular3" style="background-color: #144272;  margin: 0 auto">
        {{-- Espacios Publicitario --}}
        {{-- <div style="background-color: #0A2647">
         <p>Publicidad</p>
        </div> 
        @foreach ($publicidad as $publicida)
           @if ($publicida->codigo == "Banner")
           <a target="_blank" href="{{ route('portal.publicidad', $publicida)}}">
             <img src="{{asset($publicida->imagen)}}" alt="">
           </a> 
           @endif
         @endforeach  --}}
        </div>
    </div>
    <div class="div4" style="margin-top: 10px;">
     <div class="top-downloaded" style="background-color: #144272;display: none;">
      <div class="heading-section">
       <h5><em>Destacados</em></h5> <br> </div>
      <ul> 
        @foreach ($recomendados as $recomendado)
        <li> <a href="{{ route ('portal.detalles',$recomendado->audios)}}">
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
    <div class="most-popular3" style="background-color: #144272;  margin: 0 auto"> <br>
     <div style="display: flex; justify-content: center;">
      <h4>Buscar</h4> </div> <br>
     <div class="flex_prueba"> <a class="button_tags" href="/audiolibros">Autor</a> <a class="button_tags" href="/audiolibros">Genero</a> <a class="button_tags" href="/audiolibros">Año</a> <a class="button_tags" href="/sagas">Saga</a> <a class="button_tags" href="/top">Top</a> <a class="button_tags" href="/sugeridos">Sugeridos</a> </div> <br><br> </div> <br> {{-- Card Grupos --}}
    <div class="most-popular3" style="background-color: #144272;  margin: 0 auto">
     <div class="cards-container">
      <div class="cardsocial card-one">
       <h3>Únete</h3>
       <div class="desc"> Contamos con el mejor grupo de Soporte y Actualizaciones </div>
       <div class="footer_card"> <a target="_blank" href="#"><i class="fa-brands fa-telegram"></i></a> <a target="_blank" href="#"><i class="fa-brands fa-discord"></i></a> <a target="_blank" href="#"><i class="fa-brands fa-whatsapp"></i></a> </div>
      </div>
     </div>
    </div>
    </div> 
  </div>
 </div>    
@endsection

 

   



@section('js_padre')
{{--- Jquery ---}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
{{--- Sweet alert ---}}
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>




<script>
  // Define a global variable to store the authentication status
  var isAuthenticated = @json(auth()->check());
  var userId = @json(auth()->id());
</script>




  {{-- Mostrar todos los comentarios --}}
  <script>
    $(document).ready(function () {

      //Oculta el preloader
      var div = document.getElementById('preloader_two');
      div.style.display = 'none';


      var audio_id = "{{$audio->id}}";
  
      $.ajax({
        url: "{{ route('portal.view.comment') }}",
        type: "GET",
        data: {
          audio_id: audio_id
        },
        dataType: "json",
        success: function(response) {
          // Procesar la respuesta y mostrar los datos en la página
          var comentarios = response.comentarios;
          // console.log(comentarios);
          // Bucle: forEach  mostrarlos en el DOM
          // console.log(comentarios);
          comentarios.forEach(function(comentario) {
            
            //Formatea la fecha del comentario
            const ahora = new Date();
            const diff = ahora - new Date(comentario.created_at);
            const segundos = Math.floor(diff / 1000);
            const minutos = Math.floor(segundos / 60);
            const horas = Math.floor(minutos / 60);
            const dias = Math.floor(horas / 24);

            if (segundos < 60) {
              comentario.created_at = `Hace ${segundos} segundos`;
            } else if (minutos < 60) {
              comentario.created_at = `Hace ${minutos} minutos`;
            } else if (horas < 24) {
              comentario.created_at = `Hace ${horas} horas`;
            } else {
              comentario.created_at = `Hace ${dias} días`;
            }

      
            function printButtonIfAuthenticated(comentario, userId) {
            if (isAuthenticated && comentario.user_id == userId) {
              return '<button class="eliminar" data-id=' + comentario.id + '>Eliminar</button>';
            } else {
              return '';
            }
          }
          
          
            //Imprimier el arreglo
            var contenido = '<li id="un_comentario"><div class="comment-main-level" >' +
                            '<div class="comment-avatar"><img src="{{asset('menu/perfil.jpg')}}" alt=""></div>' +
                            '<div class="comment-box">' +
                            '<div class="comment-head">' +
                            '<h6 class="comment-name by-author">' + comentario.usuarios.name + '</h6>' +
                            '<span>' + comentario.created_at + '</span>' +
                            '</div>' +
                            '<div class="comment-content">' + comentario.comentario + '</div>' +
                            '</div>' +
                            '</div>' +
                            printButtonIfAuthenticated(comentario, userId) +
                            '</li>';
            $("#lista-comentarios").append(contenido);// Suponiendo que tienes una lista con el ID "lista-comentarios" donde quieres mostrar los datos
        
          
        
            
          });
        },
        error: function(error) {
          // console.log(error);
        }
      });
    });
  </script>
  


  @if ((Auth::check()))
  {{-- Insertar comentario AJAX --}}
  <script>
    $(document).ready(function(mostrar){
      $("#form_comentar").submit(function(event){
        event.preventDefault();

        //Mostrar Div - Carga
        var div = document.getElementById('preloader_two');
        div.style.display = 'block';

        //Enviar otros parametros
        var audio_id = "{{$audio->id}}";
        var user_id = "{{$user_id}}";
 
        var form = $("#form_comentar")[0];
        var data = new FormData(form);

        // Agregar param1 al objeto FormData
        data.append('audio_id', audio_id);
        data.append('user_id', user_id);

      
        $.ajax({
          type: "POST",
          url: "{{ route ('portal.store.comment')}}",
          data:data,
          processData:false,
          contentType:false,
          success:function(data){
            //alert(data.res);
          },
          error:function(e){
            // console.log(e.responseText);
          }
        });

        
      });
    });
  </script>







  {{-- mostrar nuevo comentario --}}
  <script>
    $("#button_comentar").on("click", function() {
      setTimeout(() => {


        var audio_id = "{{$audio->id}}";
        var validar = "1";
        $.ajax({
          url: "{{ route('portal.view.comment') }}",
          type: "GET",
          data: {
            validar: validar,
            audio_id: audio_id
          },
          dataType: "json",
          success: function(response) {
            // Procesar la respuesta y mostrar los datos en la página
            var comentario_nuevo = response.comentario_nuevo;
            // console.log(comentarios);
            // Bucle: forEach  mostrarlos en el DOM
            comentario_nuevo.forEach(function(comentario_n) {
              
              //Formatea la fecha del comentario
              const ahora = new Date();
              const diff = ahora - new Date(comentario_n.created_at);
              const segundos = Math.floor(diff / 1000);
              const minutos = Math.floor(segundos / 60);
              const horas = Math.floor(minutos / 60);
              const dias = Math.floor(horas / 24);

              if (segundos < 60) {
                comentario_n.created_at = `Hace ${segundos} segundos`;
              } else if (minutos < 60) {
                comentario_n.created_at = `Hace ${minutos} minutos`;
              } else if (horas < 24) {
                comentario_n.created_at = `Hace ${horas} horas`;
              } else {
                comentario_n.created_at = `Hace ${dias} días`;
              }

        
              
              function printButtonIfAuthenticated(comentario_n, userId) {
              if (isAuthenticated && comentario_n.user_id == userId) {
                return '<button class="eliminar" data-id=' + comentario_n.id + '>Eliminar</button>';
              } else {
                return '';
              }
            }
            
            
              //Imprimier el arreglo
              var contenido_n = '<li id="un_comentario"><div class="comment-main-level">' +
                              '<div class="comment-avatar"><img src="{{asset('menu/perfil.jpg')}}" alt=""></div>' +
                              '<div class="comment-box">' +
                              '<div class="comment-head">' +
                              '<h6 class="comment-name by-author">' + comentario_n.usuarios.name + '</h6>' +
                              '<span>' + comentario_n.created_at + '</span>' +
                              '</div>' +
                              '<div class="comment-content">' + comentario_n.comentario + '</div>' +
                              '</div>' +
                              '</div>' +
                              printButtonIfAuthenticated(comentario_n, userId) +
                              '</li>';
              $("#nuevo_comentario").append(contenido_n);// Suponiendo que tienes una lista con el ID "lista-comentarios" donde quieres mostrar los datos
          
                        
              
            });

              // Cambiar ID y Clase
              //  var elemento = document.getElementById("nuevo_comentario");
              // Para cambiar la clase del elemento
              // elemento.id = "lista-comentarios";
              // elemento.className = "comments-list"; 



          },
          error: function(error) {
            // console.log(error);
          }
        });

        //Oculta el preloader
        var div = document.getElementById('preloader_two');
        setTimeout(function () {
          div.style.display = 'none';
        }, 500);

    


        //Aparece comentario lentamente
        const elemento = document.querySelector('.comments-list');
        elemento.classList.add('elemento-visible');


         //Limpiar input, obteniendo el ID
         var inputElement = document.getElementById('comentario');
        inputElement.value = '';



    }, 2000);


     //Mensaje comentario añadido
    setTimeout(function () {       
        var toastMixin = Swal.mixin({
          toast: true,
          icon: 'success',
          title: 'General Title',
          animation: false,
          position: 'bottom-left',
          showConfirmButton: false,
          customClass: {
            popup: 'colored-toast'
          },
          timer: 4000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        });

        toastMixin.fire({
          animation: true,
          title: 'Comentario añadido'
        });

    }, 3000);

 


      
  });
  </script>



{{-- Eliminar Comentario - Guardados --}}
<script>

  $("#lista-comentarios").on("click", ".eliminar", function()
   {
    //alert($(this).attr("data-id"))
      var id = $(this).attr("data-id");
       var obj = $(this);
       $.ajax ({
        type:"GET",
        url: "/Audiolibro/delete/comment/"+id,
        success:function(data){
          // $(obj).parent().parent().remove();
          // $(obj).parent().remove();

          $(obj).parent().fadeOut(900, function() {
              $(this).remove();
          });

          //Imprime texto de exitoso
          //$("#salida").text(data.result);
        },
          error:function(err){
              console.log(err.responseText);
          }
       });


       
        //Mensaje comentario eliminado
        setTimeout(function () {       
            var toastMixin = Swal.mixin({
              toast: true,
              icon: 'error',
              title: 'General Title',
              animation: false,
              position: 'bottom-left',
              showConfirmButton: false,
              customClass: {
                popup: 'colored-toast2'
              },
              timer: 4000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            });

            toastMixin.fire({
              title: 'Comentario eliminado',
              icon: 'error'
            });

        }, 1000);
 
      

  }); 
</script>


{{-- Eliminar Nuevo Comentario --}}
<script>

  $("#nuevo_comentario").on("click", ".eliminar", function()
   {
    //alert($(this).attr("data-id"))
      var id = $(this).attr("data-id");
       var obj = $(this);
       $.ajax ({
        type:"GET",
        url: "/Audiolibro/delete/comment/"+id,
        success:function(data){
          // $(obj).parent().parent().remove();
          // $(obj).parent().remove();

          $(obj).parent().fadeOut(900, function() {
              $(this).remove();
          });

          //Imprime texto de exitoso
          //$("#salida").text(data.result);
        },
          error:function(err){
              console.log(err.responseText);
          }
       });

       //Mensaje comentario eliminado
       setTimeout(function () {       
            var toastMixin = Swal.mixin({
              toast: true,
              icon: 'error',
              title: 'General Title',
              animation: false,
              position: 'bottom-left',
              showConfirmButton: false,
              customClass: {
                popup: 'colored-toast2'
              },
              timer: 4000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            });

            toastMixin.fire({
              title: 'Comentario eliminado',
              icon: 'error'
            });

        }, 1000);

       
      
  }); 
</script>




{{-- Insertar FAVORITOS --}}
<script>
  function heart_action() {
    var heart_id = document.getElementById("heart");
    var heart_clase = heart_id.className;
    var id = {{$audio->id}};
     
      if (heart_clase == "no_guardado") {
        //Guardar a favoritos
            $.ajax ({
              type:"GET",
              url: "/audiolibro/favorito/"+id,
       
              success:function(data){
              
                //Cambiar la clase
                heart_id.className = "guardado";
                heart_id.textContent = "Guardado"; 
        

              },
                error:function(err){
                    console.log(err.responseText);
                }
            });  
        
      } else {
          //Eliminar de favoritos
          @if(isset($like))
          var id = {{$like->id}};
            $.ajax ({
              type:"GET",
              url: "/audiolibro/favorito/delete/"+id,
              success:function(data){
                 //Cambiar la clase
                 heart_id.className = "no_guardado";
                 heart_id.textContent = "Guardar";  

              },
                error:function(err){
                    console.log(err.responseText);
                }
            });  
          @endif

      }

      
    }
 
</script>


{{---Mostrar Favorito ---}}
<script>
  $(document).ready(function () {
    var heartt = document.getElementById("heart");
    var icono = document.getElementById("icono");
    var id = {{$audio->id}};
      $.ajax ({
        type:"GET",
        url: "/audiolibro/favorito/view/"+id,
        data: {
                id: id
              },
        success:function(data){
          //console.log(data.favorito_view);
          //Cambiar la clase 
            if (data.favorito_view.length === 0) {
              heartt.className = "no_guardado";
              heartt.textContent = "Guardar"; 

              icono.className = "fa-solid fa-heart";


            } else {
              heartt.className = "guardado";
              heartt.textContent = "Guardado"; 
            }  

        },
          error:function(err){
              console.log(err.responseText);
          }
      });  
      
   
  });
</script>




  @else
    {{-- FAVORITOS - NO AUTENTICADO --}}
    <script>
      function heart_action() {
        Swal.fire({
                  icon: 'error',
                  title: '¡Oops!',
                  text: 'Quieres guardar? Registrate, es GRATIS',
                  footer: '<a href="/login">Registrarse aqui'
                })
          
        }
    
    </script>
  @endif


   
  @if (session('mensaje') == 'ok')
    <script>
      setTimeout(function () {
        Swal.fire(
                'Reporte Enviado',
                'Te estaremos notificando',
                'success'
              )
      }, 1500);
    </script>
  @endif




{{-- Reproductor --}}
<script src="{{asset('js/reproductor.js')}}"></script>
@endsection

  




