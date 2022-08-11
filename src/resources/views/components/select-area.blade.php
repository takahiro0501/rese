
<div>
    <label class="arealabel">エリア</label>
    <select name="area">
    @isset($id)
        @foreach ( $areas as $area )
            <option value="{{ $area->id }}" {{ old('area' , $id) == $area->id ? 'selected' : ''}}>{{ $area->area_name }}</option>
        @endforeach
    @else
        @foreach ( $areas as $area )
            <option value="{{ $area->id }}" {{ old('area') == $area->id ? 'selected' : ''}}>{{ $area->area_name }}</option>
        @endforeach
    @endisset
    </select>
</div>
