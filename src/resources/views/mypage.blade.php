<x-default-layout>
  <div class="mypage">

    <!-- 予約情報表示（画面左） -->
    <div class="mypage__status" id="mypage__status">
      <div class="mypage__status-ttl">
        <div class="mypage__status-ttl-item active">予約状況</div>
        <div class="mypage__status-ttl-item">予約履歴</div>
      </div>
      <div class="mypage__status-cards active">
        <!-- 現在日時より未来（past=0）は、「予約状況」領域へ表示する -->
        @foreach($futures as $reservation)
          <x-status-card :reservation="$reservation" :count="$loop->iteration" past="0" />
        @endforeach
      </div>
      <div class="mypage__status-cards">
        <!-- 現在日時より過去（past=1）は、「予約履歴」領域へ表示する -->
        @foreach($pasts as $reservation)
          <x-status-card :reservation="$reservation" :count="$loop->iteration" past="1"/>
        @endforeach
      </div>
    </div>

    <!-- お気に入り店舗表示（画面右） -->
    <div class="mypage__favorite">
      <div class="mypage__favorite-username">
        {{ $name }}さん
      </div>
      <div class="mypage__favorite-ttl">
        お気に入り店舗
      </div>
      <div class="mypage__favorite-contents">
        @foreach($favorites as $favorite)
          <x-shop-card :shop="$favorite" />
        @endforeach
      </div>
    </div>
  </div>
</x-default-layout>