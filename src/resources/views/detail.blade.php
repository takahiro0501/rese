<x-detail-layout>

  <!-- ロゴ -->
  <x-slot name="logo">
    <div class="detail__logo" id="header__logo">
        <img  src="{{ asset('icon/logo.png') }}"/>
    </div>
  </x-slot>

  <!-- 店舗詳細情報 -->
  <!-- 2022/07/15評価機能実装に伴い,切り替えタブ機能追加 -->
  <x-slot name="shop">
    <div class="detail__shop-ttl" id="detail__shop-ttl">
      <div class="detail__shop-ttl-back">
        <a href="{{ route('home') }}">&lt;</a>
      </div>
      <div class="detail__shop-ttl-text">
        <div class="detail__shop-ttl-item active">{{ $shop->shop_name }}</div>
        <div class="detail__shop-ttl-item">
          <span class="deteil-review">口コミ({{ $ratingCount }})</span>
        </div>
      </div>
    </div>

    <!-- 2022/07/15評価機能実装に伴い,口コミコンテンツ追加 -->
    <div class="detail__shop-review">
      <div class="detail__shop-review-item active">
        <x-shop-detail :shop="$shop" />
      </div>
      <div class="detail__shop-review-item" >
        <x-shop-review :shop="$shop" :ratingCount="$ratingCount"/>
      </div>
    </div>
  </x-slot>

  <!-- 店舗予約 -->
  <x-slot name="reserve">
    @isset($reservation)
      <x-reserveinput :shop="$shop" :reservation="$reservation"/>
    @else
      <x-reserveinput :shop="$shop"/>
    @endisset
    </x-slot>

</x-detail-layout>
