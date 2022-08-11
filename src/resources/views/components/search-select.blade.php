<!-- home画面検索ドロップダウンメニュー -->
  <div class="search-select">
  <select {{ $attributes }}>
    <option value="{{ route('home.search', [ $word.'_id' => '0']) }}">All {{ $word }}</option>
    @foreach($items as $item)
      <option 
          value="{{ route('home.search', [ $word.'_id' => $item->id]) }}"
          {{ old( $word."_id") == $item->id ? "selected" : "" }}
      >
      {{ $item[$word.'_name'] }}
      </option>
    @endforeach
  </select>
</div>

