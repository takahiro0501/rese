<x-default-layout>

    <x-auth-card>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <!-- タイトル -->
        <div class="auth__title">
            認証メールを送信しました
        </div>
        <div class="auth__mail">
            @if (session('resent'))
                <div style="color:red">
                    認証メールを再送しました。
                </div>
            @endif
            <p>仮登録有難うございました。</p>
            <p>
                登録アドレス宛てに認証メールを送信しました。記載のリンクから本登録を完了させてください。
            </p>
            <p>
                ※メールが届かない場合は、入力したアドレスに間違いがあるか、あるいは迷惑メールフォルダに入っている可能性がありますのでご確認ください。
            </p>
        </div>
        <div class="auth__resend">
            <p>認証メールを再送する場合はこちらをクリックしてください。</p>
            <form class="auth__resend-form" method="POST" action="{{ route('verification.send') }}" >
                @csrf
                <div class="auth__resend-form-submit" >
                    <button type="submit" class="">メールを再送</button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-default-layout>
