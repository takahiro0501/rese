<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Area;

class SelectArea extends Component
{
    public $areas;
    public $id;    

    public function __construct($id=null)
    {
        $this->id = $id;
        $this->areas = Area::all();
    }

    public function render()
    {
        return view('components.select-area');
    }
}
