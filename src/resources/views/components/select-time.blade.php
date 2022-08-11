<div>
    @if ($msg == "start")
        <label class="timelabel">営業開始時間</label>
    @elseif ($msg == "end")
        <label class="timelabel">営業終了時間</label>
    @endif

    <select name="{{ $msg }}">
    @isset($dt)
        @foreach ( $times as $time )
            <option {{ $dt == $time ? 'selected' : ''}}>{{ $time }}</option>
        @endforeach
    @else
        @foreach ( $times as $time )
            <option>{{ $time }}</option>
        @endforeach
    @endisset
    </select>
</div>