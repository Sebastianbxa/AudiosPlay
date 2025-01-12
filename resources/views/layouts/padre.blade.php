<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>AudiosPlay @yield('title')</title>


  <link rel="stylesheet" href="{{asset('css/preloader.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  
  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="{{asset('assets/css/fontawesome.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/templatemo-cyborg-gaming.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/owl.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">

  <!-- Nab bar -->
  <link rel="stylesheet" href="{{asset('css/nav_bar_2.css')}}">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="{{asset('css/menu_user.css')}}">

  @yield('css_vista')
</head>


<body>
  @php
    use Carbon\Carbon;
    Carbon::setlocale(config('app.locale'));
  @endphp
  {{-- Preloader --}}
  <div class="loader-section" >
    <span class="loader"></span>
  </div>


  <header> 
    <nav class="nav2">
      <div class="menu-icon">
          <span class="fas fa-bars"></span>
      </div>
      <a href="/">
        <div class="logo">
          AudiosPlay
        </div>
      </a>
      <div class="nav2-items">
          <li><a href="/">INICIO</a></li>
          <li><a href="{{ route('portal.todos')}}">AUDIOLIBROS</a></li>
          <li><a href="{{ route('portal.peticiones')}}">PETICIONES</a></li>
          <li class="nav__item dropdown">
          <a href="#" class="nav__link dropdown__link">MAS<i class='bx bx-chevron-down dropdown__icon'></i></a>
              

          <ul class="dropdown__menu">
            <li class="dropdown__item"><a href="{{ route('portal.membresia')}}" class="nav__link">MEMBRESIA VIP</a></li>
            <li class="dropdown__item"><a href="{{ route('portal.sugeridos')}}" class="nav__link">SUGERIDOS</a></li>
            <li class="dropdown__item"><a href="{{ route('portal.top')}}" class="nav__link">TOP</a></li>  
            <li class="dropdown__item"><a href="{{ route('portal.sagas')}}" class="nav__link">SAGAS</a></li>
            <li class="dropdown__item"><a href="{{ route('portal.contacto')}}" class="nav__link">CONTACTO</a></li>

            
          </ul>
      </li>

      </div>
      <div class="search-icon">
          <span class="fas fa-search"></span>
      </div>
      <div class="cancel-icon">
          <span class="fas fa-times"></span>
      </div>
      <form class="form_menu" action="{{ url('search')}}" method="GET">
        <input type="search" class="search-data" placeholder="Buscar" name="search" value="{{ Request::get('search')}}" required>
        <button type="submit" class="fas fa-search"></button>
      </form>


    

    @if (Auth::check())
    
      <div class="action">
        <div class="profile" onclick="menuToggle();">
          
          <img src="{{asset('menu/perfil.jpg')}}">
        </div>
        <div class="menu">
          <h3>{{(auth()->user()->name)}}<br><span>Bienvenido</span></h3>
          <ul>
            @can('admin.create')
            <li><img src="{{asset('menu/settings.png')}}"><a href="{{ route ('admin.dashboard')}}">Panel</a></li>
            @endcan
            <li><img src="{{asset('menu/user.png')}}"><a href="/account/profile">Mi Perfil</a></li>
            <li><img src="{{asset('menu/membresia.png')}}"><a href="/membresia">Membresia</a></li>
            <li><img src="{{asset('menu/love.png')}}"><a href="/account/favoritos">Mis Favoritos</a></li>

            <li><img src="{{asset('menu/log-out.png')}}">
            <form action="/logout" method="POST" style="display: inline;">
              @csrf
              
                <a href="#" onclick="this.closest('form').submit()">Cerrar sesion</a>
              </li>	
            </form>
            
          </ul>
          
        </div>
      </div>       
    @else
      <div class="action">
        <div class="profile" onclick="menuToggle();">
          <a href="/login">
            <i class="fa-solid fa-user-large"></i>
          {{-- <img src="{{asset('menu/acceso.png')}}"> --}}
        </a>
        </div>
      </div>         
    @endif


    </nav>
  </header>
    
  @yield('contenido')

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>  AudiosPlay © {{ Carbon::now()->translatedFormat('Y') }}
          <a target="_blank" href="{{route('portal.terminos')}}">- Terminos y Condiciones </a> </br>
           <a target="_blank" href="{{route('portal.politica')}}">Politica de Privacidad</a>
          <a target="_blank" href="{{route('portal.dmca')}}">|| DMCA</a>
          <br>
         {{-- <a target="_blank" href="https://github.com/Minirick">Desarrollado by Duvan Cardozo</a> --}}
        </p>
        </div>
      </div>
    </div>
  </footer>



  @yield('js_padre')
  <script src="{{asset('assets/js/isotope.min.js')}}"></script>
  <script src="{{asset('assets/js/owl-carousel.js')}}"></script>
  <script src="{{asset('assets/js/tabs.js')}}"></script>
  <script src="{{asset('assets/js/popup.js')}}"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

  <script src="{{asset('js/nav_bar.js')}}"></script>
  <script src="{{asset('js/preloader.js')}}"></script>
  <script src="{{asset('js/ocultar.js')}}"></script>
  <script src="{{asset('js/menu_user.js')}}"></script>
  </body>
</html>









