<x-default-layout>
    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">

    <div class="rating">
        <div class="detail_rate" id="detail_rate">
            <!-- タイトル -->
            <div class="detail_rate-ttl">
                <div>
                    評価アンケート
                </div>
            </div>

            <!-- コンテンツ -->
            <div class="detail_rate-form">
                <form 
                    method="post" 
                    id="rate-form" 
                    class="rate-form"
                    action="{{ route('mypage.rating.store') }}" 
                >
                @csrf
                    <div class="detail_rate-form-parts">
                        店舗名：{{ $shop_name }}
                    </div>
                    <div class="detail_rate-form-parts">
                        <label for="rate-form-rating">5段階評価</label>
                        <select name="rate" id="rate-form-rating" class="rate-form-rating">
                            @for ($i = 1; $i < 6; $i++)
                                <option>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="detail_rate-form-parts">
                        <div>
                            <label for="rate-form-comment">コメント</label>
                        </div>
                        <textarea name="comment" id="rate-form-comment" class="rate-form-comment"></textarea>
                    </div>
                    <input type='hidden' name="id" value="{{ $id }}" />
                </form>
            </div>

            <!-- 送信ボタン -->
            <div class="detail_rate-submit" id="detail_rate-submit">
                <button type="submit"
                    form="rate-form" 
                    class="detail_rate-btn"
                >送信する
                </button>
            </div>
        </div>
    </div>

</x-default-layout>
