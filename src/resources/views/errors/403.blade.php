<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content=" 8; url={{ route('home') }}">
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
        
        .strong-msg{
            font-size: 24px;
            color: red;
            font-weight: bold;
            padding-bottom: 10px;
        }

</style>
</head>
<body>
    <div class="main">
        <div class="error-wrap">
            <section>
                <h1>403 Forbidden</h1>
                <p class="strong-msg">本登録が完了していません。登録アドレスに送付されたメールをご確認の上、メール認証を行ってください。</p>
                <p>またメール送信から1時間が過ぎている場合、再度、ユーザ登録画面からユーザ登録を行ってください。</p>
            </section>
        </div>
    </div>
</body>
</html>
