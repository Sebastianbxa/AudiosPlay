<div style="padding: 25px; background-color: #F3F4F6">


<x-guest-layout>
   
    <x-authentication-card s>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
       
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600" >
                {{ session('status') }}
            </div>
        @endif

      
        <form method="POST" action="{{ route('login') }}" >
            @csrf


       
            <div>
                <x-label for="email" value="{{ __('Correo') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>


          
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordar') }}</span>
                </label>
            </div>
            
            <div class="flex items-center justify-center mt-4">
                <x-button class="ml-4" style="width: 200px; height:45px; font-size:17px; justify-content: center;" >
                    {{ __('Ingresar') }}
                </x-button>
            </div>
          

      
            <div class="flex items-center justify-center mt-4">
                @if (Route::has('password.request'))
                
                   
              
                    
                    <p>¿No tienes una cuenta?</p>
                    <br><br>
                    <div class="ml-4" style="color: blue">
                    <a href="/register">Registrate</a>
                </div>
                @endif

            </div>

            <div class="flex items-center justify-center mt-4" >
                <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" style="color: blue">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            </div>

        </form>
       

    </x-authentication-card>
</x-guest-layout>
</div>