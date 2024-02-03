<?php

namespace App\Livewire\Backend\Admin\Components;

use Livewire\Component;

class MazSidebar extends Component
{
    public $href;
    public $logo;

    public function mount($href = null, $logo = null)
    {
        $this->href = $href;
        $this->logo = $logo;
    }

    public function render()
    {
        return view('livewire.backend.admin.components.maz-sidebar');
    }
}
