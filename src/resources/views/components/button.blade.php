<div class="auth-form-button">
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'auth-form-button']) }}>
        {{ $slot }}
    </button>
</div>