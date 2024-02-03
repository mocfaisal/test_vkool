<?php

namespace App\Livewire\Backend\Admin\Home;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.admin.home.index')
            ->layout("layouts.backend.admin.mainLayout");
    }
}
