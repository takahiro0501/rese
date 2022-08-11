<x-admin-layout>
  
<div class="manager">
  <div class="manager__title">
    <p>店舗代表者管理メニュー</p>
    <form action="{{ route('admin.destroy') }}" method="GET" class="admin__header-logout">
        @csrf
        <input type="submit" value="ログアウト" name="submit">
    </form>
  </div>

  <div class="manager__memu">
    @if( $user->role->id == 2)
      <div class="memu__shop-ins"><a href="{{ route('manager.shop') }}">店舗作成</a></div>
    @else
      <div id="memu__shop-ins-disable"><a tabindex="-1">店舗作成</a></div>
    @endif
    @if( $user->role->id == 2)
      <div class="memu__shop-upd-disable"><a tabindex="-1">店舗情報更新</a></div>
    @else
      <div class="memu__shop-upd"><a href="{{ route('manager.shop.update') }}">店舗情報更新</a></div>
    @endif

    <div class="memu__reservation"><a href="{{ route('manager.reservation') }}">予約確認</a></div>
  </div>
</div>

</x-admin-layout>

