<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- 共通CSS -->
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <title>Rese予約認証</title>
        <style>
          .main {
            background-color: #eeeeee;
            width: 100%;
            min-height: 100vh;
            padding-top: 200px
          }

          .qr-verify {
            width: 40%;
            margin: 0 auto;
            border-radius: 5px;
            box-shadow: 0 3px 10px 0 rgba(0, 0, 0, .5);
            background-color: white;
            padding: 20px ;
          }

          .qr-verify-ttl{
            padding-bottom: 10px;
            font-weight: bold;
          }
        </style>
    </head>

    <body>
        <div class="contents">
            <!-- コンテンツ -->
            <main class="main">
              <div class="qr-verify">
                @isset($reservation)
                  <p class="qr-verify-ttl">予約情報が確認できました。</p>
                  <p>【 ユーザ名 】  {{ $reservation->user->name }}</p>
                  <p>【 アドレス 】  {{ $reservation->user->email }}</p>
                  <p>【 予約店舗 】 {{ $reservation->shop->shop_name }}</p>
                  <p>【 予約時間 】 {{ $reservation->start_at->format('Y年m月d日 H時i分') }}</p>
                  @if($reservation->num_of_users !== 99)
                    <p>【 予約人数 】 {{ $reservation->num_of_users }}人</p>
                  @else
                    <p>【 予約人数 】 10人以上</p>
                  @endif
                @else
                    <p class="qr-verify-ttl">予約情報が確認できませんでした</p>
                @endisset
              </div>
              </main>
        </div>
    </body>
</html>
