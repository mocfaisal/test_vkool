<?php

namespace App\Livewire\Backend\Simulation;

use Livewire\Component;

class Index extends Component {
    private $current_user_id;

    public $is_edit = false;
    public $id_customer = 1;
    public $status = 0;

    public $id;
    public $curr_id_trx;
    public $input_id_inventory;
    public $is_attribute;
    public $input_nama;
    public $input_posisi_kaca;
    public $input_warna;
    public $input_service;
    public $input_ukur_l;
    public $input_ukur_p;

    public $id_posisi_kaca;
    public $id_warna;
    public $id_service;

    public function render() {
        return view('livewire.backend.simulation.index')
            ->layout("layouts.backend.admin.mainLayout");
    }
}
