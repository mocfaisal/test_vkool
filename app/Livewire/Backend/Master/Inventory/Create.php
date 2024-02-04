<?php

namespace App\Livewire\Backend\Master\Inventory;

use Livewire\Component;
use Session;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;

use App\Models\Table\m_inventory;
use App\Models\Table\m_posisi_kaca;
use App\Models\Table\m_warna;
use App\Models\Table\m_service;

class Create extends Component {
    private $current_user_id;

    public $is_edit = false;

    public $list_posisi_kaca = [];
    public $list_warna = [];
    public $list_service = [];

    public $id;
    public $input_posisi_kaca;
    public $input_warna;
    public $input_service;
    public $input_ukur_l;
    public $input_ukur_p;

    #[Rule('required')]
    public $input_nama;
    public $is_attribute = false;

    public function __construct() {
        $this->current_user_id = Session::get('user_id');
    }

    function mount() {
        $this->list_posisi_kaca = m_posisi_kaca::select('id', 'nama')
            ->where('is_active', '1')
            ->get()->toArray();

        $this->list_warna = m_warna::select('id', 'nama')
            ->where('is_active', '1')
            ->get()->toArray();

        $this->list_service = m_service::select('id', 'nama')
            ->where('is_active', '1')
            ->get()->toArray();
    }

    public function render() {
        return view('livewire.backend.master.inventory.create')
            ->layout('layouts.backend.admin.mainLayout');
    }
    public function save() {
        // $this->skipRender();

        try {
            $this->validate();

            $current_user_id =  $this->current_user_id ?? Session::get('user_id');

            $is_attribute = $this->is_attribute ? 1 : 0;

            $id_posisi_kaca = $this->input_posisi_kaca;
            $id_warna = $this->input_warna;
            $id_service = $this->input_service;
            $input_ukur_l = $this->input_ukur_l;
            $input_ukur_p = $this->input_ukur_p;

            if ($is_attribute == 0) {
                $id_posisi_kaca = null;
                $id_warna = null;
                $id_service = null;
            }

            $datasave = [
                'nama' => $this->input_nama,
                'is_attribute' => $is_attribute,
                'id_posisi_kaca' => $id_posisi_kaca,
                'id_warna' => $id_warna,
                'id_service' => $id_service,
                'ukur_lebar' => $input_ukur_l,
                'ukur_panjang' => $input_ukur_p,
            ];

            if ($this->is_edit) {
                $datasave['updated_by'] = $current_user_id;
                $save = m_inventory::where('id', $this->id)
                    // ->where('created_by', $current_user_id)
                    ->update($datasave);
            } else {
                $datasave['created_by'] = $current_user_id;
                $save = m_inventory::create($datasave);
            }

            if ($save) {
                $this->dispatch('refresh-data');
                $r = ['success' => true, 'msg' => 'Data berhasil disimpan!'];

                // Reset the form after saving
                $this->resetForm();
            } else {
                $r = ['success' => false, 'msg' => 'Data gagal disimpan!'];
            }

            return $this->dispatch('showResult', result: $r);
        } catch (\Throwable $th) {
            $r = ['success' => false, 'msg' => $th->getMessage()];
        }

        return $this->dispatch('showResult', result: $r);
    }

    #[On('edit-mode')]
    function edit($id) {
        $this->is_edit = true;
        $data = m_inventory::where('id', $id)
            ->where('created_by', $this->current_user_id)
            ->first();

        $this->id = $id;
        $this->input_nama = $data->nama;
        $this->is_attribute = ($data->is_attribute == 1 ? true : false);
        $this->input_posisi_kaca = $data->id_posisi_kaca;
        $this->input_warna = $data->id_warna;
        $this->input_service = $data->id_service;
        $this->input_ukur_l = $data->ukur_lebar;
        $this->input_ukur_p = $data->ukur_panjang;
        return false;
    }

    #[On('reset-modal')]
    public function resetForm() {
        // $this->reset(['input_nama', 'is_attribute']);
        $this->reset();
    }
}
