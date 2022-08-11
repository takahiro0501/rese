<x-default-layout>
  <div class="payment">
    <div class="flex">
      <p class="payment-ttl">支払い情報入力</p>
      <form action="{{ route('mypage') }}" method="GET">
        <input type="image" src="{{ asset('icon/batu-black.png') }}" />
      </form>
    </div>
    <form id="payment__form" method="post" action="{{ route('mypage.pay') }}">
      @csrf
      <div class="form-parts">
        <label for="money">お支払い金額</label>
        <input type="number" name="money" class="money"/>
      </div>
      <div class="form-parts">
          <label for="card-number" class="card-number-label">カード番号</label>          
          <div id="card-number" class="card-number"></div>
      </div>
      <div class="form-parts">
        <label for="card-expiry">有効期限</label>
        <div id="card-expiry"></div>
      </div>
      <div class="form-parts">
        <label for="card-cvc">セキュリティーコード</label>
        <div id="card-cvc"></div>
      </div>
      <div id="card-errors"></div>
      <input type="hidden" name="id" value="{{ $reservation_id }}" />
      <div class="payment-btn">
        <input type="submit" value="支払いをする" />
      </div>
    </form>
  </div>

</x-default-layout>
