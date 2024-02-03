<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use session;
use App\Models\Core\ParmadModel;
use App\Models\table\m_jadwal_kelas;
use App\Models\Table\tr_mhs_jadwal_kelas;
use App\Models\table\tr_mhs_semester;
use App\Models\table\tr_mhs_khs;

class DataModel extends Model {
    // use HasFactory;
    private $parmad;


    public function __construct() {
        $this->parmad = new ParmadModel;
    }



    function update_semester($nim) {
        // NOTE Update Data from API to Database
        // NOTE get semester by NIM

        $data = $this->parmad->get_semester($nim);

        $save = false;

        if ($data) {

            // dd($data);

            if (isset($data['data']) && !empty($data['data'])) {
                $searchData = [];
                $dataSave = [];
                $temp_data = $data['data'];

                foreach ($temp_data as $key => $val) {

                    $semester_id = $val['sempId'];
                    $semester_int = $val['semester'];
                    $semester_txt = $val['SEM_NAMA'];

                    $searchData = [
                        'nim' => $nim,
                        'semester_int' => $semester_int,
                    ];

                    $dataSave = [
                        'semester_id' => $semester_id,
                        'semester_name' => $semester_txt,
                    ];


                    $save = tr_mhs_semester::updateOrCreate($searchData, $dataSave);
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
