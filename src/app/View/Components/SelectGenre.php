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

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-genre');
    }
}
