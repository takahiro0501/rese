@props(['value','icon'])

<div class="auth__form-parts">
  <div class="auth__form-img">
    <img src="{{ asset('icon').$icon }}"/>
  </div>
  <div  class="auth__form-inp">
    <input value="{{ old($attributes['id']) }}" {{ $attributes->merge(['placeholder' => $value ]) }}"/>
  </div>
</div>
