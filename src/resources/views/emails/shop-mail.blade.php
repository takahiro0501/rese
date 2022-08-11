<!DOCTYPE html>
<html>
<head>
    <title>Reseメール</title>
</head>
<body>
    <h3>{{ $details['name'] }} 様</h3>
    <p>{{ $details['body'] }}</p>
    @if( isset($details['shop_name']))
        <p>【予約店舗名】 {{ $details['shop_name'] }}</p>
        <p>【予約日時】 {{ $details['datetime']->format('Y年m月d日 H時i分') }}</p>
        <p>【予約人数】 {{ $details['number'] }}</p>
    @endif
</body>
</html>
