
<div class="detail__shop-review-contents">
    @if ( $ratingCount == 0 )
        現在、口コミはありません。
    @else
        @foreach ( $shop->reservations as $reservation)
            <!-- 予約データがあり評価データもある場合 -->
            @if ( $reservation->rating !== null )
                <div class="review-content">
                    <div class="review-content-name">
                        {{ $reservation->name->name }}さん
                    </div>
                    <div class="review-content-date">
                        来店日：{{ $reservation->start_at->format('Y年m月d日') }}
                    </div>
                    <div class="review-content-rate">
                        評価：
                        @switch ( $reservation->rating->rating )
                            @case(1)
                                <img src="{{ asset('icon/star1.png') }}" alt="星1つ">
                                @break
                            @case(2)
                                <img src="{{ asset('icon/star2.png') }}" alt="星2つ">
                                @break
                            @case(3)
                                <img src="{{ asset('icon/star3.png') }}" alt="星3つ">
                                @break
                            @case(4)
                                <img src="{{ asset('icon/star4.png') }}" alt="星4つ">
                                @break
                            @case(5)
                                <img src="{{ asset('icon/star5.png') }}" alt="星5つ">
                                @break
                            @endswitch
                        </div>
                    <div class="review-content-comment">
                        {{ $reservation->rating->comment }}
                    </div>
                </div>
            @endif
        @endforeach
    @endif
    </div>
