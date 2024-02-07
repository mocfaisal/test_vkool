<?php

namespace App\Livewire\Backend\Transaksi\Penjualan;

use Livewire\Component;
use Illuminate\Http\Request;
use Session;
use DataTables;
use Livewire\Attributes\On;
use DB;
use App\Models\Table\m_inventory;
use App\Models\Table\tr_penjualan;
use App\Models\Table\tr_penjualan_detail;
use App\Models\Utils\Salz_utils;

class Index extends Component {
    public $current_user_id;
    private $Salz_utils;

    public function __construct() {
        $this->current_user_id = Session::get('user_id');
        $this->Salz_utils = new Salz_utils;
    }

    public function render() {
        return view('livewire.backend.transaksi.penjualan.index')
            ->layout("layouts.backend.admin.mainLayout");
    }

    public function getData(Request $request) {
        $this->skipRender();

        if ($request->ajax()) {
            $new_data = [];
            $curr_user_id = $this->current_user_id;
            $limit = $request->input('length');

            $data = tr_penjualan::where('created_by', $curr_user_id)
                ->where('status', '1')
                ->limit($limit)->get()->toArray();

            if (!empty($data)) {
                foreach ($data as $key => $val) {
                    $new_data[] = $val;
                }
            }

            return DataTables::of($new_data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<a href="' . route('backend.transaksi.penjualan.edit', ['id_trx' => $row['id']]) . '" class="btn icon btn-primary" data-bs-tooltip="true" data-bs-title="Edit" wire:navigate)" ><i class="bi bi-pencil"></i></a>';
                    $btn .= ' | <a href="javascript:void(0);" onclick="popDelete(' . $row['id'] . ')" class="btn icon btn-danger" data-bs-title="Delete"><i class="bi bi-x"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->only(['id', 'nama_transaksi', 'nama_customer', 'tgl_transaksi', 'status', 'total_item', 'action'])
                ->make(true);
        } else {
            return false;
        }
    }

    public function destroy($id) {
        $this->skipRender();

        $delete = tr_penjualan::where('created_by', $this->current_user_id)->where('id', $id)->delete();

        if ($delete) {
            tr_penjualan_detail::where('id_penjualan', $id)->delete();
            $r = ['success' => true, 'msg' => 'Data berhasil dihapus!'];
        } else {
            $r = ['success' => false, 'msg' => 'Data gagal dihapus!'];
        }

        $this->dispatch('showResult', result: $r);
    }
}
