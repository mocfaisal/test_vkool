<?php

namespace App\Livewire\Backend\Mahasiswa\Jadwal;

use Livewire\Component;
use DB;
use session;
use App\Models\Core\ParmadModel;
use App\Models\table\m_jadwal_kelas;
use App\Models\Table\tr_mhs_jadwal_kelas;

class Index extends Component {
    private $parmad;

    public $input_nim;
    public $list_data = [];

    public function render() {
        return view('livewire.backend.mahasiswa.jadwal.index')
            ->layout("layouts.backend.admin.mainLayout");
    }


    public function __construct()
    {
        $this->parmad = new ParmadModel;
    }


    function mount() {
        if (empty($this->input_nim)) {
            $this->input_nim = '121203006';
        }
    }

    function getData() {
        // $this->skipRender();
        $nim = $this->input_nim;

        $new_data = [];
        $data = tr_mhs_jadwal_kelas::select('a.kelas_id', 'a.kelas_kode', 'a.matkul_kode', 'a.matkul_nama', 'c.dosen_username', 'a.dosen_nama', 'a.hari_no', 'a.hari_nama', 'a.jadwal_mulai', 'a.jadwal_selesai', 'a.ruangan_kode', 'a.ruangan_nama')
            ->from('tr_mhs_jadwal_kelas as b')
            ->join('m_jadwal_kelas as a', 'b.kelas_id', '=', 'a.kelas_id', 'inner')
            ->join('m_dosen as c', 'c.dosen_nama', '=', 'a.dosen_nama', 'left')
            ->join('tr_mhs_khs as d', 'd.matkul_kode', '=', 'a.matkul_kode')
            ->join(DB::raw('( SELECT * FROM tr_mhs_semester ORDER BY semester_id DESC LIMIT 1 ) as e'), function ($join) {
                $join->on('b.nim', '=', 'e.nim');
                $join->on('d.semester', '=', 'e.semester_int');
            })
            ->where('a.is_active', '1')
            ->where('b.nim', $nim)
            ->orderBy('a.hari_no', 'asc')
            ->orderBy('a.jadwal_mulai', 'asc')
            ->get()->toArray();


        if (!empty($data)) {
            foreach ($data as $key => $val) {
                // print_r($val);exit;

                $act = '';
                $dosen_nama = $val['dosen_nama'];

                if (!empty($val['dosen_username'])) {
                    $dosen_nama = '~' . $val['dosen_nama'];
                }

                $val['dosen_nama'] = $dosen_nama;

                // $act = '<a href="' . route('mahasiswa.kelas.forum', ['id_kelas' => $val['kelas_id']])  . '" class="btn icon btn-primary" title="Forum Diskusi Kelas"><i class="bi bi-chat-left-dots"></i></a>';
                // $act .= ' | <a href="' . route('mahasiswa.kelas.list_mhs', ['id_kelas' => $val['kelas_id']])  . '" class="btn icon btn-success" title="List Mahasiswa"><i class="bi bi-people"></i></a>';

                // $link = route('mahasiswa.kelas.forum', ["id_kelas" => $val['kelas_id']]);

                // $val['kelas_kode'] = '<a href="' . $link . '">' . $val['kelas_kode'] . '</a>';
                $val['act'] = $act;

                $new_data[] = $val;
            }
        }

        $this->list_data = $new_data;
        // return false;
    }

    function updateData(){
        $nim = $this->input_nim;

        $data = $this->parmad->get_jadwal($nim);
        $save = false;

        if ($data) {
            if (isset($data['data']) && !empty($data['data'])) {
                $searchData = [];
                $dataSave = [];
                $temp_data = $data['data'];

                foreach ($temp_data as $key => $val) {

                    $searchData = [
                        // 'nim' => $nim,
                        'kelas_id' => $val['klsId'],
                    ];

                    $searchData2 = [
                        'nim' => $nim,
                        'kelas_id' => $val['klsId'],
                    ];

                    $dataSave = [
                        // 'nim' => $nim,
                        // 'kelas_id' => $val['klsId'],
                        'kelas_kode' => $val['klsNama'],
                        'matkul_kode' => $val['mkkurKode'],
                        'matkul_nama' => $val['mkkurNamaResmi'],
                        // 'dosen_id' => $val['DOSEN_KELAS'],
                        'dosen_nama' => $val['DOSEN_KELAS'],
                        'hari_no' => $val['noDay'],
                        'hari_nama' => $val['jdkulHari'],
                        'jadwal_mulai' => $val['jdkulJamMulai'],
                        'jadwal_selesai' => $val['jdkulJamSelesai'],
                        'ruangan_kode' => $val['ruKode'],
                        'ruangan_nama' => $val['ruNama'],
                    ];

                    $dataSave2 = [
                        'kelas_id' => $val['klsId'],
                    ];

                    $save = m_jadwal_kelas::updateOrCreate($searchData, $dataSave);
                    $save2 = tr_mhs_jadwal_kelas::updateOrCreate($searchData2, $dataSave2);
                }

                if ($save) {
                    $r = ['success' => true, 'msg' => 'Data update success!'];
                } else {
                    $r = ['success' => false, 'msg' => 'Data update failed!'];
                }
            } else {
                $r = ['success' => false, 'msg' => 'Data kosong!'];
            }
        } else {
            $r = ['success' => false, 'msg' => 'Error API!'];
        }

        return response()->json($r);
    }
}
