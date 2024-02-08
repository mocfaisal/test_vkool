<?php

namespace App\Livewire\Backend\Report;

use Livewire\Component;
use Illuminate\Http\Request;
use Session;
use DataTables;
use Livewire\Attributes\On;
use DB;
use App\Models\Table\m_inventory;
use App\Models\Table\tr_penjualan;
use App\Models\Table\tr_penjualan_detail;
use Livewire\Attributes\Computed;
use Barryvdh\DomPDF\Facade\Pdf;
use Nette\Utils\Random;

class Index extends Component {
    public $current_user_id;
    public $date_start = null;
    public $date_end = null;

    public function __construct() {
        $this->current_user_id = Session::get('user_id');
    }

    public function render() {
        return view('livewire.backend.report.index')
            ->layout("layouts.backend.admin.mainLayout");
    }

    function searchData() {
        $data = $this->dataCart();
        return $data;
    }

    function printReport() {
        $this->skipRender();

        $filename = Random::generate(10) . '.pdf';

        // $pdf = PDF::loadview('livewire.frontend.transaction.report.reportViewPDF', ['viewData' => $this->searchData()]);
        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream();
        // }, $filename);


        $pdfContent = PDF::loadview(
            'livewire.backend.report.reportViewPDF',
            [
                'viewData' => $this->searchData(),
                'date' => ['start' => $this->date_start, 'end' => $this->date_end]
            ]
        )->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            $filename
        );
    }

    #[Computed]
    function dataCart() {
        $new_data = null;

        if ($this->date_start > $this->date_end) {
            $this->date_start = $this->date_end;
        }

        if (!empty($this->date_start) && !empty($this->date_end)) {
            $data =  tr_penjualan::select('*')
                ->where('id_customer', $this->current_user_id)
                // ->where('status', '1')
                ->whereBetween('tgl_transaksi', [$this->date_start, $this->date_end])
                ->get();

            foreach ($data as $key => $val) {
                $val->status = $val->status == 1 ? 'Complete' : 'Pending';
                $val->detail = tr_penjualan_detail::where('id_penjualan', $val->id)->get();
                $new_data[] = $val;
            }
            return $new_data;
        } else {
            return false;
        }
    }
}
