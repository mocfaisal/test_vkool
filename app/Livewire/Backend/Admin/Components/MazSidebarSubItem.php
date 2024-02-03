<?php

namespace App\Livewire\Backend\Admin\Components;

use Livewire\Component;

class MazSidebarSubItem extends Component
{
    public $link;
    public $name;
    public $navigate;

    public function mount($link = null, $name = null, $navigate = null)
    {

        $this->link = $link;
        $this->name = $name;
        $this->navigate = $navigate;
    }

    public function render()
    {
        return view('livewire.backend.admin.components.maz-sidebar-sub-item');
    }
}
