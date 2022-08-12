<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Genre;

class SelectGenre extends Component
{

    public $genres;
    public $id;

    public function __construct($id=null)
    {
        $this->id = $id;
        $this->genres = Genre::all();
    }

    public function render()
    {
        return view('components.select-genre');
    }
}
