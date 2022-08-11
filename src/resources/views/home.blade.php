<x-default-layout>
  <!-- 検索ボックス -->
  <x-slot name="search">
    <div class="search-box">

      <!-- エリアドロップダウンメニュー -->
      <x-search-select :items="$areas" word="area" id="search-area" class="search-area" name="area" />

      <!-- ジャンルドロップダウンメニュー -->
      <x-search-select :items="$genres" word="genre" id="search-genre" class="search-genre" name="genre" />

      <!-- キーワード検索 -->
      <div class="search-input">
        <img src="{{ asset('icon/search.png') }}" class="search-img">
        <input id="keyword" class="keyword" placeholder="Search..."  value="{{ old('keyword') }}"/>
      </div>
    </div>
  </x-slot>

  <!-- 店舗一覧表示 -->
  <div class="main__content">
    @foreach($shops as $shop)
      <x-shop-card  :shop="$shop" />
    @endforeach
  </div>

</x-default-layout>
