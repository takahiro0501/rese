
<div class="detail__shop-img">
    <img src="{{ $shop->img }}" alt="εΊθη»ε">
</div>
<div class="detail__shop-text">
    <div class="detail__shop-text-tag">
    <p>#{{ $shop->area->area_name }}</p>
    <p>#{{ $shop->genre->genre_name }}</p>
    </div>
    <div class="detail__shop-text-content">
    <p>{{ $shop->overview }}</p>
    </div>
</div>      
