<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content=" 3; url={{ route('admin.login') }}">
    <title>403 Forbidden</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <style>
        .main {
            background-color: #eeeeee;
            width: 100%;
            height: 100vh;
            padding-top: 150px;
        }
        .error-wrap {
            padding: 30px 20px;
            border: 1px solid #dcdcdc;
            box-shadow: 0px 0px 8px #dcdcdc;
            background-color: white;
            width: 40%;
            margin: 0 auto;
        }
        h1 { 
            font-size: 24px; 
            padding-bottom: 20px;
        }
        p { font-size: 20px; }

</style>
</head>
<body>
    <div class="main">
        <div class="error-wrap">
            <section>
                <h1>403 Forbidden</h1>
                <p>閲覧権限がありません。ログインページへ移動します。</p>
            </section>
        </div>
    </div>
</body>
</html>