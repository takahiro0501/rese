<div>
    <label class="genrelabel">ジャンル</label>
    <select name="genre">
    @isset($id)
        @foreach ( $genres as $genre )
            <option value="{{ $genre->id }}" {{ old('genre' , $id) == $genre->id ? 'selected' : ''}}>{{ $genre->genre_name }}</option>
        @endforeach
    @else
        @foreach ( $genres as $genre )
            <option value="{{ $genre->id }}" {{ old('genre') == $genre->id ? 'selected' : ''}}>{{ $genre->genre_name }}</option>
        @endforeach
    @endisset
    </select>
</div>
