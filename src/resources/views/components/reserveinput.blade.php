<!-- 予約の入力領域 -->
<div class="detail_reserve" id="detail_reserve">
    <div class="detail_reserve-ttl">
        @isset($reservation)
            <div>予約を修正</div>
        @else
            <div>予約</div>
        @endisset
    </div>
    <div class="detail_reserve-form">
        <form 
            method="post" 
            id="reserve-form" 
            class="reserve-form"
            @isset($reservation)
                action="{{ route('reserve.re') }}" 
            @else
                action="{{ route('reserve') }}" 
            @endisset
        >
        @csrf
            <input 
                type="date" 
                name="date"
                class="reserve-form-date" 
                id="reserve-form-date"
                @isset($reservation)
                    value="{{ Str::substr($reservation->start_at, 0, 10) }}"
                @else
                    value="{{ old('date', \Carbon\Carbon::now()->format("Y-m-d") ) }}"
                @endisset
            >
            @error('date')
                <div class="detail_date-err">{{$errors->first('date')}}</div>
            @enderror
            <select name="time" class="reserve-form-time" id="reserve-form-time">
            @foreach( $times as $time)
                <option 
                    @isset($reservation)
                        {{ Str::substr($reservation->start_at,11,5)==$time ? 'selected' : '' }}
                    @else
                        {{ old('time')==$time ? 'selected' : '' }}
                    @endisset
                    >
                    {{ $time }}
                </option>
            @endforeach
            </select>
            @error('datetime')
                <div class="detail_date-err">{{$errors->first('datetime')}}</div>
            @enderror
            <select name="number" class="reserve-form-number" id="reserve-form-number">
                @for ($i = 1; $i < 10; $i++)
                    <option
                    @isset($reservation)
                        {{ $reservation->num_of_users == $i ? 'selected' : '' }}
                    @else
                        {{ old('number')== $i.'人' ? 'selected' : '' }}
                    @endisset
                    >{{ $i }}人</option>
                @endfor
                <option
                    @isset($reservation)                    
                        {{ $reservation->num_of_users == 99 ? 'selected' : '' }}
                    @else
                        {{ old('number')== '10人以上' ? 'selected' : '' }}
                    @endisset
                    >10人以上</option>
            </select>
            <input type="hidden" name="datetime" value="test"  id="reserve-form-datetime"/>
            <input
                type='hidden'
                name="id"
                @isset($reservation)                
                    value="{{ $reservation->id }}" 
                @else
                    value="{{ $shop->id }}" 
                @endisset
            />
            </form>
    </div>

    <!-- 予約情報の確認領域 -->
    <div class="detail_reserve-comfirm">
        <div>
            <p class="detail_reserve-comfirm-ttl">Shop</p>
            <p id="detail_reserve-comfirm-shop">{{ $shop->shop_name }}</p>
        </div>
        <div>
            <p class="detail_reserve-comfirm-ttl">Date</p>
            <p class="detail_reserve-comfirm-date">
                @isset($reservation)
                    {{ Str::substr($reservation->start_at, 0, 10) }}
                @else
                    {{ old('date', \Carbon\Carbon::now()->format("Y-m-d") ) }}
                @endisset
                </p>
        </div>
        <div>
            <p class="detail_reserve-comfirm-ttl">Time</p>
            <p class="detail_reserve-comfirm-time">
            @isset($reservation)
                {{ Str::substr($reservation->start_at,11,5) }}
            @else
                {{ old('time','17:00') }}
            @endisset
            </p>
        </div>
        <div>
            <p class="detail_reserve-comfirm-ttl">Number</p>
            <p class="detail_reserve-comfirm-number">
            @isset($reservation)
                @if($reservation->num_of_users == 99)
                    10人以上
                @else
                    {{ $reservation->num_of_users }}人
                @endif
            @else
                {{ old('number', '1人') }}
            @endisset
            </p>
        </div>
    </div>

    <!-- 予約ボタン -->
    <div class="detail_reserve-submit" id="detail_reserve-submit">
        <button type="submit"
                form="reserve-form" 
                class="detail_reserve-btn"
                id="detail_reserve-btn"
                >
                @isset ( $reservation )
                    予約を修正する
                @else
                    予約する
                @endisset
        </button>
        @guest
            <div id="loginAlert"></div>
        @endguest
    </div>
</div>

