<x-default-layout>
  <div class="qr-contents">
    @if(isset($url))
    <div class="qr-contents-ttl">
      <p class="qr-contents-ttl-msg">予約情報QRコード表示</p>
      <p>来店時に下記QRコードを店舗スタッフへ提示してください。</p>
    </div>
    <div class="qr-contents-gd">
      {!! QrCode::size(200)->generate($url); !!}
    </div>
    <div class="qr-contents-back">
      <a href="{{ route('mypage') }}" style="color:white;">Mypageへ戻る</a>
    </div>  
  </div>
  <!-- 本番運用時は削除 -->
  <div class="test">
      <p>テストの為、URL表示。本番運用時は削除</p>
      {{ $url }}
  </div> 
  @elseif(isset($token))
    {{ $token }}
  @endif
</x-default-layout>