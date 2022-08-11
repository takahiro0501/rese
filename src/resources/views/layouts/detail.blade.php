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
        <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
        <title>Rese 店舗詳細</title>


    </head>

    <body>
        <div class="detail">
            
            <!-- メニュー用モーダルウィンドウ -->
            <div id="modal" class="modal">
                <x-menu />
            </div>

            <!-- コンテンツ -->
            <div class="detail__contents">
                <!-- 左側コンテンツ -->
                <div class="detail__contents-left">
                    <div class="detail__contents-left-logo">
                        {{ $logo }}
                    </div>
                    <div class="detail__contents-left-shop">
                        {{ $shop }}
                    </div>
                </div>

                <!-- 右側コンテンツ -->
                <div class="detail__contents-right">
                    <div class="detail__contents-right-reserve">
                        {{ $reserve }}
                    </div>
                </div>
            </div>
            
        </div>

        <script src="{{ asset('js/default.js') }}"></script>
    </body>
</html>
