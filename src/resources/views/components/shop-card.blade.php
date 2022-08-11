<div class="shopcard">
    <div class="shopcard-img">
        <img src="{{ $shop->img }}" />
    </div>
    <p class="shopcard-ttl">{{ $shop->shop_name }}</p>
    <div class="flex">
        <p class="shopcard-area">#{{ $shop->area->area_name}}</p>
        <p class="shopcard-gnere">#{{ $shop->genre->genre_name}}</p>
    </div>
    <div class="flex-between">
        <form method="GET" class="form">
            @csrf
            <button 
                type="submit" 
                formaction="{{ route('detail', ['shop_id' => $shop->id]) }}" 
                class="shopcard-detail"
            >
                詳しく見る
            </button>
        </form>
        @guest
        <div>
            <img src="{{ asset('icon/haert-nonactive.png') }}" class="favorite-img"/>
        </div>
        @endguest
        @auth
            @if(!Auth::user()->is_favorite($shop->id))
                <form action="{{ route('favorite.store', ['shop_id' => $shop->id] ) }}" method="POST">
                @csrf
                    <input type="image" src="{{ asset('icon/haert-nonactive.png') }}" alt="お気に入り" class="favorite-img">
                </form>
            @else
                <form action="{{ route('favorite.destory', ['shop_id' => $shop->id] ) }}" method="POST">
                    @csrf
                    <input type="image" src="{{ asset('icon/haert-active.png') }}" alt="お気に入り" class="favorite-img">
                </form>
            @endif
        @endauth
    </div>
</div>
