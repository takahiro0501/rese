<x-default-layout>
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">

  <div class="thanks">
    <div class="thanks__msg">
      {{ $msg }}
    </div>
    <div class="thanks__btn">
      <button>
        @if ( $msg == 'ご予約ありがとうございます' )
          <a href="{{ route('home') }}">{{ $btn }}する</a>
        @elseif ( $msg == '予約の変更を受け付けました' || $msg == '評価ありがとうございます' || 'お支払いが正常に完了しました')
          <a href="{{ route('mypage') }}">{{ $btn }}する</a>
        @elseif ( $msg == '会員登録ありがとうございます' )
          <a href="{{ route('login') }}">{{ $btn }}する</a>
        @endif
        </button>
    </div>
  </div>

</x-default-layout>
