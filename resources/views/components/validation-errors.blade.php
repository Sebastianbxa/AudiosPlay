@if ($errors->any())
    <div {{ $attributes }} class="flex items-center justify-center mt-5">
        <div class="font-medium text-red-600">{{ __('Usuario o contraseña incorrectos') }}</div>
    </div>
@endif
