<x-default-layout>
    <x-auth-card>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- タイトル -->
            <div class="auth__title">
                Login
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
                />
                <x-auth-validation-error  
                        :errors="$errors" 
                        :value="__('password')"
                />
            </div>

            <!-- ログイン失敗時 -->
            <div >
                <x-auth-validation-error  
                        :errors="$errors" 
                        :value="__('authfail')"
                />
            </div>

            <div>
                <x-button>{{ __('ログイン') }}</x-button>
            </div>
        </form>
    </x-auth-card>
</x-default-layout>
