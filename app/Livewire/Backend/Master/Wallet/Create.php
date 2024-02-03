<?php

namespace App\Livewire\Backend\Master\Wallet;

use Livewire\Component;
use Session;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;
use App\Models\Table\Transaksi\Wallet as tr_wallet;

class Create extends Component {
    private $current_user_id;

    public $is_edit = false;

    public $id;

    #[Rule('required')]
    public $input_nama;
    public $input_cb_default;

    public function __construct() {
        $this->current_user_id = Session::get('user_id');
    }

    public function render() {
        return view('livewire.backend.master.wallet.create')
            ->layout('layouts.backend.admin.mainLayout');
    }

    public function save() {
        // $this->skipRender();

        try {
            $this->validate();

            $current_user_id =  $this->current_user_id ?? Session::get('user_id');

            // dd($this->input_nama, $this->input_cb_default, $current_user_id, $this->is_edit, $this->id);

            $datasave = [
                'nama' => $this->input_nama,
                'is_default' => $this->input_cb_default ?? 0,
            ];

            if ($this->input_cb_default == 1) {
                tr_wallet::where('created_by', $current_user_id)
                    ->update(['is_default' => 0]);
            }

            if ($this->is_edit) {
                $datasave['updated_by'] = $current_user_id;
                $save = tr_wallet::where('id', $this->id)
                    // ->where('created_by', $current_user_id)
                    ->update($datasave);
            } else {
                $datasave['created_by'] = $current_user_id;
                $save = tr_wallet::create($datasave);
            }

            if ($save) {
                $this->dispatch('refresh-data');
                $r = ['success' => true, 'msg' => 'Data successfully saved!'];

                // Reset the form after saving
                $this->resetForm();
            } else {
                $r = ['success' => false, 'msg' => 'Data save failed!'];
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
        $data = tr_wallet::where('id', $id)
            ->where('created_by', $this->current_user_id)
            ->first();

        $this->id = $id;
        $this->input_nama = $data->nama;
        $this->input_cb_default = ($data->is_default == 1 ? true : false);
    }

    #[On('reset-modal')]
    public function resetForm() {
        // $this->reset(['input_nama', 'input_cb_default']);
        $this->reset();
    }
}
