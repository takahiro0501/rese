@props(['errors','value'])

@error($value) 
    <div class="auth__form-error">{{ $errors->first($value) }}</div>
@enderror

