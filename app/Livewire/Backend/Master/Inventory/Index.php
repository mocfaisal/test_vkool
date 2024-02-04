<?php

namespace App\Livewire\Backend\Master\Inventory;

use Livewire\Component;
use Illuminate\Http\Request;
use Session;
use DataTables;
use Livewire\Attributes\On;
use DB;
use App\Models\Table\m_inventory;
use App\Models\Utils\Salz_utils;

class Index extends Component {
    public $current_user_id;
    private $Salz_utils;

    public function __construct() {
        $this->current_user_id = Session::get('user_id');
        $this->Salz_utils = new Salz_utils;
    }

    public function render() {
        return view('livewire.backend.master.inventory.index')
            ->layout("layouts.backend.admin.mainLayout");
    }

    public function getData(Request $request) {
        $this->skipRender();

        if ($request->ajax()) {
            $new_data = [];
            $curr_user_id = $this->current_user_id;
            $limit = $request->input('length');

            $data = m_inventory::selectRaw('m_inventory.*, m_posisi_kaca.nama as nm_posisi_kaca, m_warna.nama as nm_warna, m_service.nama as nm_service')
                ->leftJoin('m_posisi_kaca', 'm_posisi_kaca.id', '=', 'id_posisi_kaca')
                ->leftJoin('m_warna', 'm_warna.id', '=', 'id_warna')
                ->leftJoin('m_service', 'm_service.id', '=', 'id_service')
                ->where('m_inventory.created_by', $curr_user_id)
                ->where('m_inventory.is_active', '1')
                ->limit($limit)->get()->toArray();

            if (!empty($data)) {
                foreach ($data as $key => $val) {
                    $new_data[] = $val;
                }
            }

            return DataTables::of($new_data)->addIndexColumn()
                ->editColumn('is_attribute', function ($row) {
                    $btn = '';
                    if ($row['is_attribute'] == 1) {
                        $btn .= '<button type="button" class="btn icon btn-success"  data-bs-tooltip="true" data-bs-title="Ada atribut"><i class="bi bi-check"></i></button>';
                    } else {
                        $btn .= '<button type="button" class="btn icon btn-danger"  data-bs-tooltip="true" data-bs-title="Non Atribut"><i class="bi bi-x-circle-fill"></i></button>';
                    }
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<a href="javascript:void(0);" class="btn icon btn-primary" data-bs-tooltip="true" data-bs-title="Edit" wire:click="$dispatch(\'edit-mode\',{id: ' . $row['id'] . '})" ><i class="bi bi-pencil"></i></a>';
                    $btn .= ' | <a href="javascript:void(0);" onclick="popDelete(' . $row['id'] . ')" class="btn icon btn-danger" data-bs-title="Delete"><i class="bi bi-x"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'is_attribute'])
                ->only(['id', 'nama', 'ukur_lebar', 'ukur_panjang', 'is_attribute', 'nm_posisi_kaca', 'nm_warna', 'nm_service', 'action'])
                ->make(true);
        } else {
            return false;
        }
    }

    public function destroy($id) {
        $this->skipRender();

        $delete = m_inventory::where('created_by', $this->current_user_id)->where('id', $id)->delete();

        if ($delete) {
            $r = ['success' => true, 'msg' => 'Data berhasil dihapus!'];
        } else {
            $r = ['success' => false, 'msg' => 'Data gagal dihapus!'];
        }

        $this->dispatch('showResult', result: $r);
    }
}
