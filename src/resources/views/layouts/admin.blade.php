<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- 共通CSS -->
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin/manager.css') }}">
        <title>Rese管理画面</title>
    </head>

    <body>
        <main class="main">
                {{ $slot }}
        </main>

    <script src="{{ asset('js/admin.js') }}"></script>
    </body>

</html>
