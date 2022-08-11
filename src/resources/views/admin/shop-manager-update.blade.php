<x-admin-layout>

<div class="manager">
    <div class="manager__title">
        <p>店舗情報更新画面</p>
        <form action="{{ route('manager.home') }}" method="GET" class="admin__header-logout">
            @csrf
            <input type="submit" value="戻る" name="back">
        </form>
        <form action="{{ route('admin.destroy') }}" method="GET" class="admin__header-logout">
            @csrf
            <input type="submit" value="ログアウト" name="submit">
        </form>
    </div>

    <div class="manager__shop">
        <form action="{{ route('manager.shop.update.exec') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="admin__form-parts">
                <label class="namelabel">店舗名</label>
                <input type="text" name="name" value="{{ old('name', $shop->shop_name) }}">
                @error('name')
                    <div class="admin__form-error">{{ $errors->first('name') }}</div>
                @enderror            
            </div>
            <div class="admin__form-parts">
                <label class="overviewlabel">店舗詳細</label>
                <textarea name="overview" class="shop-overview" >{{ old('overview' , $shop->overview) }}</textarea>
                @error('overview') 
                    <div class="admin__form-error">{{ $errors->first('overview') }}</div>
                @enderror
            </div>
            <div class="admin__form-parts">
                <x-select-area :id="$shop->area_id"/>
            </div>
            <div class="admin__form-parts">
                <x-select-genre :id="$shop->genre_id"/>
            </div>
            <div class="admin__form-parts">
                <x-select-time msg="start" :id="$shop->id" /> 
            </div>
            <div class="admin__form-parts">
                <x-select-time msg="end" :id="$shop->id" /> 
            </div>
            <div class="shop__form-parts">
                <label class="filelabel">店舗画像</label>
                <input type="file" name="file" class="shop-img" id="shop-img" accept=".gif,.jpg,.jpeg,.png" />
                @error('file')
                    <div class="admin__form-error">{{ $errors->first('file') }}</div>
                @enderror
                <div id="preview"></div>
            </div>
            <input type="hidden" name="id" value="{{ $shop->id }}">
            <div class="admin__form-submit">
                <input type="submit" name="submit"  class="shop-btn" value="店舗情報更新" />
            </div>
        </form>
    </div>
</div>

</x-admin-layout>

