<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- 共通CSS -->
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/default.css') }}">
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

        <!-- ページごとに設定 -->
        @if ( request()->is('*home*') )
            <link rel="stylesheet" href="{{ asset('css/home.css') }}">
            <title>Rese 店舗情報一覧</title>
        @elseif ( request()->is('*login*') || request()->is('*register*') )
            <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
            <title>Rese 認証</title>
        @elseif ( request()->is('*reservation*') )
            <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
            <title>Rese 予約</title>
        @elseif ( request()->is('*pay*') )
            <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
            <title>Rese 支払い画面</title>
        @elseif ( request()->is('*mypage*') )
            <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
            <title>Rese マイページ</title>
        @endif
            <title>Rese</title>

    </head>

    <body>
        <div class="contents">

            <!-- メニュー用モーダルウィンドウ -->
            <div id="modal" class="modal">
                <x-menu />
            </div>

            <!-- ヘッダー -->
            <header class="header">
                <!-- ロゴ -->
                @if ( !request()->is('*mailsend*') )
                    <div class="header__logo" id="header__logo">
                        <img  src="{{ asset('icon/logo.png') }}"/>
                    </div>
                @endif
                <!-- 検索ボックス -->
                @if ( request()->is('*home*') )
                    <div id="header__search" class="header__search">
                            {{ $search }}
                    </div>
                @endif
            </header>

            <!-- コンテンツ -->
            <main class="main">
                {{ $slot }}
            </main>
        </div>

        @if ( request()->is('*pay*') )
            <script src="https://js.stripe.com/v3/"></script>
            <script src="{{ asset('js/payment.js') }}"></script>
        @else
            <script src="{{ asset('js/default.js') }}"></script>
        @endif

        </body>
</html>
