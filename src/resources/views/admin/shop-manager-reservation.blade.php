<x-admin-layout>

<div class="manager">
    <div class="manager__title">
        <p>予約情報確認画面</p>
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
        <form action="{{ route('manager.search') }}"  method="GET">
            <div class="admin__form-parts dateform">
            <label>予約日</label>
                <input type="date" name="date" value="{{ old('date') }}">
            </div>
            <div class="admin__form-parts reserve-select">
                <label>予約時間</label>
                <select name="time" class="reserve-form-time dateform" id="reserve-form-time">
                <option value=""></option>
                @foreach( $times as $time)
                    <option {{ old('time')==$time ? 'selected' : '' }} >
                        {{ $time }}
                    </option>
                @endforeach
                </select>
            </div>
            <div class="admin__form-parts reserve-select">
                <label>予約人数</label>
                <select name="number" class="reserve-form-number  dateform" id="reserve-form-number">
                    <option value=""></option>
                    @for ($i = 1; $i < 10; $i++)
                        <option value="{{ $i }}" {{ old('number')== $i ? 'selected' : '' }}>
                            {{ $i }}人
                        </option>
                    @endfor
                    <option value="99" {{ old('number')== 99 ? 'selected' : '' }}>
                        10人以上
                    </option>
            </select>
            </div>
            <div class="admin__form-submit" >
                <input type="submit" name="submit"  class="shop-btn" value="予約情報検索" />
            </div>
        </form>
    </div>

    <div class="admin__result">
        <div class="admin__result-ttl">
            <p>予約情報一覧</p>
            <p>全{{ count($reservations) }}件</p>
        </div>
        <table class="admin__result-reservation">
            <tr>
                <th>ユーザ名</td>
                <th>店舗名</td>
                <th>予約日</td>
                <th>予約時間</td>
                <th>予約人数</td>                    
                <th></td>    
            </tr>
            @foreach ( $reservations as $reservation )
                <tr>
                    <td>
                        {{ $reservation->name->name }}
                    </td>
                    <td>
                        {{ $reservation->shop->shop_name }}
                    </td>
                    <td class="admin__result-datetime">
                        {{ $reservation->start_at->format('Y年m月d日')  }}
                    </td>
                    <td class="admin__result-datetime">
                        {{ $reservation->start_at->format('H時i分')  }}
                    </td>
                    <td>
                        @if( $reservation->num_of_users !== 99 )
                            {{ $reservation->num_of_users }}人
                        @else
                            10人以上
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('manager.mail',['user_id' => $reservation->user_id ]) }}" method="GET" class="admin__result-mail">
                            <input type="submit" value="メールを送る" class="admin__result-mail-btn">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

</x-admin-layout>

