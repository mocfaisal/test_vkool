<?php

namespace App\Livewire\Backend\Admin\Components;

use Livewire\Component;

class MazSidebarItem extends Component
{
    public $icon;
    public $link;
    public $name;
    public $navigate;

    public function mount($icon = null, $link = null, $name = null, $navigate = null)
    {
        $this->icon = $icon;
        $this->link = $link;
        $this->name = $name;
        $this->navigate = $navigate;
    }

    public function render()
    {
        return view('livewire.backend.admin.components.maz-sidebar-item');
    }
}
