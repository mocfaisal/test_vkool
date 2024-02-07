<?php

namespace App\Livewire\Backend\Transaksi\Penjualan;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Http\Request;
use Session;

use App\Models\Table\m_inventory;
use App\Models\Table\tr_penjualan;
use App\Models\Table\tr_penjualan_detail;

class Create extends Component {
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

    #[Rule('required')]
    public $input_nama_trx;
    public $input_nama_customer;

    public function __construct() {
        $this->current_user_id = Session::get('user_id');
    }

    public function render() {
        return view('livewire.backend.transaksi.penjualan.create')
            ->layout("layouts.backend.admin.mainLayout");
    }

    function mount($id_trx = null) {
        if ($this->is_edit) {
            $this->status = 1;
        }

        if (empty($id_trx)) {
            // if (empty($this->curr_id_trx)) {

            $data_trx = tr_penjualan::where('status', $this->status)
                ->where('created_by', $this->current_user_id)
                ->first();

            if ($data_trx) {
                $this->curr_id_trx = $data_trx->id;
                $this->input_nama_trx = $data_trx->nama_transaksi;
                $this->input_nama_customer = $data_trx->nama_customer;
            }
        } else {
            $data_trx = tr_penjualan::where('id', $id_trx)
                ->where('created_by', $this->current_user_id)
                ->first();

            if ($data_trx) {
                $this->is_edit = true;
                $this->curr_id_trx = $data_trx->id;
                $this->input_nama_trx = $data_trx->nama_transaksi;
                $this->input_nama_customer = $data_trx->nama_customer;
            }
        }
    }

    #[Computed]
    function listDetail() {
        // list data detail
        return tr_penjualan::select('b.id', 'b.nama', 'b.is_attribute', 'b.nm_posisi_kaca', 'b.nm_warna', 'b.nm_service', 'b.ukur_lebar', 'b.ukur_panjang', 'b.qty')
            ->join('tr_penjualan_detail as b', 'b.id_penjualan', '=', 'tr_penjualan.id')
            // ->where('tr_penjualan.status', $this->status)
            ->where('tr_penjualan.id', $this->curr_id_trx)
            ->where('tr_penjualan.created_by', $this->current_user_id)
            ->get();
    }

    function getListInventory(Request $request) {
        $term = $request->search;
        $new_data = [];
        $data = m_inventory::selectRaw('m_inventory.id, m_inventory.nama, m_inventory.nama as value, m_inventory.is_attribute, m_inventory.ukur_lebar,  m_inventory.ukur_panjang, m_inventory.id_posisi_kaca, m_inventory.id_warna, m_inventory.id_service, m_posisi_kaca.nama as nm_posisi_kaca, m_warna.nama as nm_warna, m_service.nama as nm_service')
            ->leftJoin('m_posisi_kaca', 'm_posisi_kaca.id', '=', 'm_inventory.id_posisi_kaca')
            ->leftJoin('m_warna', 'm_warna.id', '=', 'm_inventory.id_warna')
            ->leftJoin('m_service', 'm_service.id', '=', 'm_inventory.id_service')
            ->where('m_inventory.nama', 'like', '%' . $term . '%')
            ->limit(5)
            ->get();

        if ($data) {
            foreach ($data as $key => $val) {
                $val->value = $val->nama . ' (' . ($val->is_attribute == 1 ?  'Ada Atribut' : 'Non Atribut') . ')';
                $new_data[] = $val;
            }
        }

        return response()->json($new_data, 200);
    }

    function processAddItem() {
        $this->skipRender();

        $id_trx = null;
        $save = false;

        if (empty($this->curr_id_trx)) {
            $nama_transaksi = $this->input_nama_trx;
            $id_customer = $this->id_customer;
            $nama_customer = $this->input_nama_customer;

            $dataSave = [
                'nama_transaksi' => $nama_transaksi,
                'id_customer' => $id_customer,
                'nama_customer' => $nama_customer,
                'tgl_transaksi' => date('Y-m-d H:i:s'),
                'status' => 0,
                'total_item' => 0,
                'created_by' => $this->current_user_id,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $id_trx = tr_penjualan::insertGetId($dataSave);
            $this->curr_id_trx = $id_trx;
        } else {
            $id_trx = $this->curr_id_trx;
        }

        // NOTE Check existing data inventory
        $curr_detail_exists = tr_penjualan_detail::where('id_penjualan', $id_trx)
            ->where('id_inventory', $this->input_id_inventory)->first();

        $dataSave_detail = [
            'id_penjualan' => $id_trx,
            'id_inventory' => $this->input_id_inventory,
            'is_attribute' => $this->is_attribute,
            'id_posisi_kaca' => $this->id_posisi_kaca,
            'id_warna' => $this->id_warna,
            'id_service' => $this->id_service,
            'nama' => $this->input_nama,
            'ukur_lebar' => $this->input_ukur_l,
            'ukur_panjang' => $this->input_ukur_p,
            'nm_posisi_kaca' => $this->input_posisi_kaca,
            'nm_warna' => $this->input_warna,
            'nm_service' => $this->input_service,
        ];

        if ($curr_detail_exists) {
            // update qty
            $dataSave_detail['updated_by'] =  $this->current_user_id;
            $dataSave_detail['updated_at'] =  date('Y-m-d H:i:s');
            $dataSave_detail['qty'] = ($curr_detail_exists->qty ?? 0) + ($this->input_qty ?? 1);
            $save = $curr_detail_exists->update($dataSave_detail);
        } else {
            $dataSave_detail['created_by'] =  $this->current_user_id;
            $dataSave_detail['created_at'] =  date('Y-m-d H:i:s');
            $dataSave_detail['qty'] = 1;
            $save = tr_penjualan_detail::insert($dataSave_detail);
        }

        if ($save) {
            $this->resetDetail();

            $r = ['success' => true, 'msg' => 'Data berhasil disimpan!'];
        } else {
            $r = ['success' => false, 'msg' => 'Data gagal disimpan!'];
        }

        $this->dispatch('showResult', result: $r);
    }

    function processSave() {
        $this->skipRender();
        // NOTE Check if id)transaction is exists or not
        // NOTE If note exists then get
        // dd($this->curr_id_trx);

        $save = false;

        if (!empty($this->curr_id_trx)) {
            $total_item = tr_penjualan_detail::where('id_penjualan', $this->curr_id_trx)->count() ?? 0;

            $dataSave = [
                'status' => 1,
                'total_item' => $total_item,
                'updated_by' => $this->current_user_id,
            ];

            $save = tr_penjualan::where('id', $this->curr_id_trx)->update($dataSave);
        }

        if ($save) {
            $r = ['success' => true, 'msg' => 'Data berhasil disimpan!', 'uri' => route('backend.transaksi.penjualan')];
        } else {
            $r = ['success' => false, 'msg' => 'Data gagal disimpan!'];
        }

        $this->dispatch('showResult', result: $r);
    }

    function processCancel() {
        $this->skipRender();
        // NOTE remove all data from table pnjuan & detail
    }

    function resetDetail() {
        $this->reset(['input_id_inventory', 'id_posisi_kaca', 'id_warna', 'id_service', 'input_nama', 'input_posisi_kaca', 'input_warna', 'input_service', 'input_ukur_l', 'input_ukur_p']);
    }

    public function destroy($id) {
        $this->skipRender();

        $delete = tr_penjualan_detail::where('created_by', $this->current_user_id)->where('id', $id)->delete();

        if ($delete) {
            $total_item = tr_penjualan_detail::where('id_penjualan', $this->curr_id_trx)->count() ?? 0;

            $dataSave = [
                'status' => 1,
                'total_item' => $total_item,
                'updated_by' => $this->current_user_id,
            ];

            $save = tr_penjualan::where('id', $this->curr_id_trx)->update($dataSave);

            $r = ['success' => true, 'msg' => 'Data berhasil dihapus!'];
        } else {
            $r = ['success' => false, 'msg' => 'Data gagal dihapus!'];
        }

        $this->dispatch('showResult', result: $r);
    }
}
