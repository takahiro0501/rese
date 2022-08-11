<x-default-layout>
    <x-auth-card>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <!-- タイトル -->
        <div class="auth__title">
            本登録が完了しました
        </div>
        <div class="auth__message">
            <p>本登録有難うございました。</p>
            <p>下記リンクより、ホーム画面へ移動してください。</p>

        </div>
        <div class="auth__jump">
            <a class="auth__jump-btn" href="{{ route('home') }}" style="color:white;">ホーム画面へ移動</a>
        </div>
    </x-auth-card>
</x-default-layout>
