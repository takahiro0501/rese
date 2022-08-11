<x-admin-layout>

    <div class="auth" >
        <form method="POST" action="{{ route('admin.store') }}">
            @csrf
            <!-- タイトル -->
            <div class="auth__title">
                Manager Login
            </div>

            <!-- メールアドレス -->
            <div>
                <x-auth-input 
                        id="email" 
                        type="email" 
                        name="email"
                        :value="__('Email')"  
                        :icon="__('/email.png')" 
                        autofocus 
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
            <div >
                <x-auth-validation-error  
                        :errors="$errors" 
                        :value="__('permissionfail')"
                />
            </div>
        <div>
            <x-button>{{ __('ログイン') }}</x-button>
        </div>
    </form>







    </div>

</x-admin-layout>
