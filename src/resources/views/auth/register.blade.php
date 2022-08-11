<x-default-layout>

    <x-auth-card>
        <!-- タイトル -->
        <div class="auth__title">
            Registration
        </div>

        <form method="POST" action="{{ route('register') }}"  class="auth__form">
        @csrf

        <!-- ユーザネーム -->
        <div>
            <x-auth-input 
                    id="name" 
                    type="text" 
                    name="name"
                    :value="__('Username')"  
                    :icon="__('/person.png')" 
                    autofocus 
            />
            <x-auth-validation-error  
                    :errors="$errors" 
                    :value="__('name')"
            />
        </div>

        <!-- Emailアドレス -->
        <div>
            <x-auth-input 
                    id="email" 
                    type="text" 
                    name="email" 
                    :value="__('Email')"  
                    :icon="__('/email.png')" 
            />
            <x-auth-validation-error  
                    :errors="$errors" 
                    :value="__('email')"
            />
        </div>

        <!-- パスワード -->
        <div>
            <x-auth-input 
                    id="password" 
                    type="password" 
                    name="password" 
                    :value="__('Password')"  
                    :icon="__('/key.png')" 
                    autocomplete="new-password"
            />
            <x-auth-validation-error  
                    :errors="$errors" 
                    :value="__('password')"
            />
        </div>

        <div>
            <x-button>{{ __('登録') }}</x-button>
        </div>
        </form>
    </x-auth-card>
</x-default-layout>
