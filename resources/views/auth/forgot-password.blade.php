
{{---Sweet Alert---}}
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>


{{--- Sweet alert ---}}
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>



<div style="padding: 25px; background-color: #F3F4F6">

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Por favor, introduce tu correo electronico y recibirás un mensaje para restablecer la contraseña.') }}
        </div>

        @if (session('status'))
            {{-- <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div> --}}
            <script>
                setTimeout(function () {
                  Swal.fire(
                          'Enviado al correo',
                          'Revisa el correo electronico para restablecer la contraseña',
                          'success'
                        )
                }, 1500);

                var inputElement = document.getElementById('email');
                inputElement.value = '';
              </script>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Correo electronico') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Obtener nueva contraseña') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
</div>