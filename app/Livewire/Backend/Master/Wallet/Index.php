<?php

namespace App\Livewire\Backend\Master\Wallet;

use Livewire\Component;
use Illuminate\Http\Request;
use Session;
use DataTables;
use Livewire\Attributes\On;
use DB;
use App\Models\Table\Transaksi\Wallet as tr_wallet;
use App\Models\Utils\Salz_utils;

class Index extends Component {
    public $current_user_id;
    private $Salz_utils;

    public function __construct() {
        $this->current_user_id = Session::get('user_id');
        $this->Salz_utils = new Salz_utils;
    }

    // public function mount() {
    //     $this->current_user_id = Session::get('user_id');
    // }

    public function render() {
        return view('livewire.backend.master.wallet.index')
            ->layout("layouts.backend.admin.mainLayout");
    }

    public function getData(Request $request) {
        $this->skipRender();

        if ($request->ajax()) {
            $new_data = [];
            $curr_user_id = $this->current_user_id;

            $get = tr_wallet::get_current_nominal($curr_user_id);

            $data = $this->Salz_utils->convertStdToArray($get);

            if (!empty($data)) {
                foreach ($data as $key => $val) {
                    // $val['nominal'] = $val['total_nominal_saldo'] ?? 0;
                    $new_data[] = $val;
                }
            }

            return DataTables::of($new_data)->addIndexColumn()
                ->editColumn('is_default', function ($row) {
                    $btn = '';
                    if ($row['is_default'] == 1) {
                        // $btn .= '<button type="button" onclick="popStatus(' . $row['id'] . ', 0);" class="btn icon btn-success" data-bs-title="Ubah jadi non default?"><i class="bi bi-check"></i></button>';
                        $btn .= '<button type="button" class="btn icon btn-success" data-bs-title="Tidak bisa mengubah jadi non default"><i class="bi bi-check"></i></button>';
                    } else {
                        $btn .= '<button type="button" onclick="popStatus(' . $row['id'] . ', 1);" class="btn icon btn-danger" data-bs-title="Ubah jadi default?"><i class="bi bi-x-circle-fill"></i></button>';
                    }
                    return $btn;
                })->addColumn('nominal', function ($row) {
                    // return "Rp. " . $row['total_nominal_saldo_format'];
                    return $row['total_nominal_saldo'];
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<a href="javascript:void(0);" class="btn icon btn-primary" data-bs-tooltip="true" data-bs-title="Edit" data-bs-toggle="modal" data-bs-target="#mdl_wallet" wire:click="$dispatch(\'edit-mode\',{id: ' . $row['id'] . '})" ><i class="bi bi-pencil"></i></a>';
                    $btn .= ' | <a href="javascript:void(0);" onclick="popDelete(' . $row['id'] . ')" class="btn icon btn-danger" data-bs-title="Delete"><i class="bi bi-x"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'nominal', 'is_default'])
                ->only(['id', 'nama', 'is_default', 'nominal', 'action'])
                ->make(true);
        } else {
            return false;
        }
    }

    public function update_status($id, $stat) {
        $this->skipRender();

        $final_stat = null;

        $dataSave = [
            'updated_by' => $this->current_user_id,
        ];

        if ($stat == 1) {
            $final_stat = 1;
            tr_wallet::where('created_by', $this->current_user_id)
                ->update(['is_default' => 0]);
        } elseif ($stat == 0) {
            $final_stat = 0;
        }

        $dataSave['is_default'] = $final_stat;

        $result = tr_wallet::where('id', $id)->update($dataSave);

        if ($result) {

            tr_wallet::update_all_nominal($this->current_user_id, $id);

            $r = ['success' => true, 'msg' => 'Status successfully updated!'];
        } else {
            $r = ['success' => false, 'msg' => 'Status update failed!'];
        }

        // dispatch to current js function
        $this->dispatch('showResult', result: $r);
    }

    public function destroy($id) {
        $this->skipRender();

        $delete = tr_wallet::where('created_by', $this->current_user_id)->where('id', $id)->delete();

        if ($delete) {
            $r = ['success' => true, 'msg' => 'Data successfully deleted!'];
        } else {
            $r = ['success' => false, 'msg' => 'Data delete failed!'];
        }

        $this->dispatch('showResult', result: $r);
    }
}
