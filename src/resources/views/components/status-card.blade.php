<div class="mypage__status-card">
    <!-- タイトル -->
    <div class="mypage__status-card-ttl">
        <div>
            <img src="{{ asset('icon/clock.png') }}">
        </div>
        <div>
            予約 {{ $count }} 
        </div>
        <!-- 予約削除ボタン（過去予約の場合は表示しない） -->
        @if ( $past == '0')
            <div class="batu-circle">
                <form action="{{ route('mypage.destory' , ['reservation_id' => $reservation->id]) }}" method="get">
                    <input type="image" src="{{ asset('icon/batu-circle.png')}}" />
                </form>
            </div>
        @endif
    </div>

    <!-- 予約情報表示 -->
    <div class="mypage__status-card-content">
        <p class="mypage__status-card-name">Shop</p>
        <p>{{ $reservation->shop->shop_name }}</p>
    </div>
    <div class="mypage__status-card-content">
        <p class="mypage__status-card-name">Date</p>
        <p>{{ Str::substr($reservation->start_at, 0, 10) }}</p>
    </div>
    <div class="mypage__status-card-content">
        <p class="mypage__status-card-name">Time</p>
        <p>{{ Str::substr($reservation->start_at, 11, 5) }}</p>
    </div>
    <div class="mypage__status-card-content">
        <p class="mypage__status-card-name">Number</p>
        @if ($reservation->num_of_users == 99)
            <p>10人以上</p>
        @else
            <p>{{ $reservation->num_of_users }}人</p>
        @endif
    </div>

    <!-- ボタン表示（「予約を変更」「QRコードを発行」「決済する」「評価する」） -->
    <div class="mypage__status-card-change">
        <!-- 現在日時より未来の場合 -->
        @if ( $past == '0')
            <!-- QR予約照合をしていない場合 -->
            @if($reservation->visited == 0)
                <!-- 追加機能：QRコード発行 -->
                <div class="mypage__status-card-flex">
                    <form action="{{ route('mypage.qr', ['reservation_id' => $reservation->id] ) }}" method="get">
                        <button type="submit" class="mypage__status-card-changeBtn qr" id="mypage__status-card-changeBtn">QRコードを発行</button>
                    </form>
                    <form action="{{ route('detail', ['shop_id' => $reservation->shop_id , 'reservation_id' => $reservation->id] ) }}" method="get">
                        <button type="submit" class="mypage__status-card-changeBtn" id="mypage__status-card-changeBtn">予約を変更</button>
                    </form>
                </div>
            <!-- QR予約照合をしている場合 -->
            @elseif($reservation->visited == 1)
                <!-- 決済を行っていない場合 -->
                @if($reservation->payment == 0)
                    <form action="{{ route('mypage.payment', ['reservation_id' => $reservation->id] ) }}" method="get">
                        <button type="submit" class="mypage__status-card-changeBtn qr" id="mypage__status-card-changeBtn">決済する</button>
                    </form>
                <!-- 決済を行っている場合 -->
                @elseif ($reservation->payment == 1)
                    <div>
                        <button class="mypage__status-card-changeBtn qr" id="mypage__status-card-changeBtn">決済済み</button>
                    </div>
                @endif
            @endif
        <!-- 現在日時より過去の場合 -->
        @elseif ( $past == '1')
            <!-- 評価済みの場合 -->
            @if ( $reservation->is_rating() )
                <button class="mypage__status-card-rateBtn-done" id="mypage__status-card-rateBtn-done" >評価済</button>
            <!-- 評価をしていない場合 -->
            @else
                <form action="{{ route('mypage.rating' , ['reservation_id' => $reservation->id , 'shop_name' => $reservation->shop->shop_name ]) }}" method="get">
                    <button  type="submit" class="mypage__status-card-rateBtn" id="mypage__status-card-rateBtn" >評価する</button>
                </form>
            @endif
        @endif
    </div>
</div>

