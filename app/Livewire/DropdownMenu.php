<?php

namespace App\Livewire;

use Livewire\Component;

class DropdownMenu extends Component
{
    public $id;
    public $label;
    public $items = [];

    public function mount($id, $label, $items)
    {
        $this->id = $id;
        $this->label = $label;
        $this->items = $items;
    }
    
    public function render()
    {
        return view('livewire.dropdown-menu');
    }
}
