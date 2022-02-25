<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Type extends Component
{
    public $selection=null;
    public function render()
    {
        return view('livewire.type');
    }
}
