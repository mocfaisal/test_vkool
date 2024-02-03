<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\ApiCustom;

class ParmadModel extends Model {
    // use HasFactory;
    protected $salz_api;

    public function __construct() {
        parent::__construct();
        $this->host = config('api_config.host');
        $this->user_agent = config('api_config.user_agent');
        $this->auth_key = config('api_config.auth_key');
        $this->auth_val = config('api_config.auth_val');
        $this->content_type = config('api_config.content_type');
        $this->salz_api = new ApiCustom();
    }

    function get_foto($type = 2, $img) {
        $assets_path = '';

        if (!empty($img)) {
            if ($type == 1) {
                // Dosen
                $assets_path = config('api_config.assets.foto.dosen');
            } elseif ($type == 2) {
                // Mahasiswa
                $assets_path = config('api_config.assets.foto.mahasiswa');
            }

            return $this->host . $assets_path . $img;
        } else {
            if ($type == 1) {
                // Dosen
                $assets_path = config('app_config.image.foto.dosen');
            } elseif ($type == 2) {
                // Mahasiswa
                $assets_path = config('app_config.image.foto.mahasiswa');
            }

            return asset('assets/backend') . $assets_path;
        }
    }

    public function get_user_info($username) {
        // With Auth Token

        /*
     $username = nim untuk mahasiswa
     $username = nip (pegNip) untuk dosen
     */


        /*
     result
     {
         "code": 1,
         "data": {
             "username": { nim / pegNip},
             "full_name": { nama / pegNama},
             "foto_profil": "{foto}",
             "role_usr": {dosen / mahasiswa}
         },
         "message": "yes"
     }

     */

        $link = $this->host . 'home/getInfoUser';

        $headers = [
            $this->auth_key => $this->auth_val,
            // 'User_Agent'=>$this->user_agent,
        ];

        $is_withContentType  = true;
        $is_withAuthToken = false;

        $data = [
            'username' => $username
        ];

        $this->salz_api->set_method('POST');
        $this->salz_api->set_host($link);
        $this->salz_api->set_header($headers, $is_withContentType, $is_withAuthToken);
        $this->salz_api->set_content_type($this->content_type);
        $this->salz_api->set_body($data);
        $result = $this->salz_api->exec();

        return $result;
    }

    public function get_presensi($nim) {
        // With Auth Token

        /*
     $token = null
     $nim = nim untuk mahasiswa
     */


        /*
     result
       {
         "code": 1,
         "data": [
             {
                 "SEMP_ID": "340000149",
                 "MK_NAMA": "Komputer dan Masyarakat\r\n",
                 "MK_KODE": "181030306",
                 "MK_SKS": "2",
                 "KLS_NAMA": "221181030306B D11",
                 "KLS_ID": "340022705",
                 "JUMLAH_HADIR": "8",
                 "JUMLAH_IJIN": "0",
                 "JUMLAH_TIDAK_HADIR": "0",
                 "TOTAL_PERTEMUAN": "8"
             },
             {
                 "SEMP_ID": "340000149",
                 "MK_NAMA": "Matematika Komputer\r\n",
                 "MK_KODE": "181030307",
                 "MK_SKS": "3",
                 "KLS_NAMA": "221181030307C C11",
                 "KLS_ID": "340022723",
                 "JUMLAH_HADIR": "9",
                 "JUMLAH_IJIN": "0",
                 "JUMLAH_TIDAK_HADIR": "0",
                 "TOTAL_PERTEMUAN": "9"
             },
             {
                 "SEMP_ID": "340000149",
                 "MK_NAMA": "Animasi\r\n",
                 "MK_KODE": "181030302",
                 "MK_SKS": "3",
                 "KLS_NAMA": "221181030302C C11",
                 "KLS_ID": "340022724",
                 "JUMLAH_HADIR": "9",
                 "JUMLAH_IJIN": "0",
                 "JUMLAH_TIDAK_HADIR": "0",
                 "TOTAL_PERTEMUAN": "9"
             },
             {
                 "SEMP_ID": "340000149",
                 "MK_NAMA": "Algoritma dan Pemrograman II\r\n",
                 "MK_KODE": "181030301",
                 "MK_SKS": "3",
                 "KLS_NAMA": "221181030301C C13",
                 "KLS_ID": "340022725",
                 "JUMLAH_HADIR": "8",
                 "JUMLAH_IJIN": "0",
                 "JUMLAH_TIDAK_HADIR": "0",
                 "TOTAL_PERTEMUAN": "8"
             },
             {
                 "SEMP_ID": "340000149",
                 "MK_NAMA": "Jaringan Komputer\r\n",
                 "MK_KODE": "181030305",
                 "MK_SKS": "3",
                 "KLS_NAMA": "221181030305C C11",
                 "KLS_ID": "340022726",
                 "JUMLAH_HADIR": "8",
                 "JUMLAH_IJIN": "0",
                 "JUMLAH_TIDAK_HADIR": "0",
                 "TOTAL_PERTEMUAN": "8"
             },
             {
                 "SEMP_ID": "340000149",
                 "MK_NAMA": "Arsitektur Komputer\r\n",
                 "MK_KODE": "181030303",
                 "MK_SKS": "3",
                 "KLS_NAMA": "221181030303B C11",
                 "KLS_ID": "340022727",
                 "JUMLAH_HADIR": "9",
                 "JUMLAH_IJIN": "0",
                 "JUMLAH_TIDAK_HADIR": "0",
                 "TOTAL_PERTEMUAN": "9"
             },
             {
                 "SEMP_ID": "340000149",
                 "MK_NAMA": "Praktikum Algoritma dan Pemrograman II\r\n",
                 "MK_KODE": "181030308",
                 "MK_SKS": "1",
                 "KLS_NAMA": "221181030308B C13",
                 "KLS_ID": "340022728",
                 "JUMLAH_HADIR": "7",
                 "JUMLAH_IJIN": "0",
                 "JUMLAH_TIDAK_HADIR": "0",
                 "TOTAL_PERTEMUAN": "7"
             },
             {
                 "SEMP_ID": "340000149",
                 "MK_NAMA": "Bahasa Inggris II\r\n",
                 "MK_KODE": "181030304",
                 "MK_SKS": "2",
                 "KLS_NAMA": "221181030304B C13",
                 "KLS_ID": "340022729",
                 "JUMLAH_HADIR": "9",
                 "JUMLAH_IJIN": "0",
                 "JUMLAH_TIDAK_HADIR": "0",
                 "TOTAL_PERTEMUAN": "9"
             }
         ],
         "message": "sukses!"
        }
             */

        $link = $this->host . 'home/get_presensi';

        $headers = [
            $this->auth_key => $this->auth_val,
            // 'User_Agent'=>$this->user_agent,
        ];

        $is_withContentType  = true;
        $is_withAuthToken = false;

        $data = [
            'nim' => $nim
        ];

        $this->salz_api->set_method('POST');
        $this->salz_api->set_host($link);
        $this->salz_api->set_header($headers, $is_withContentType, $is_withAuthToken);
        $this->salz_api->set_content_type($this->content_type);
        $this->salz_api->set_body($data);
        $result = $this->salz_api->exec();

        return $result;
    }

    public function getSemesterAktif($nim) {
        // With Auth Token

        /*
     $token = null
     $nim = nim untuk mahasiswa
     */

        /*
         Result


         {
             "code": 1,
             "data": {
                 "sempId": "340000149",
                 "semester": "20221",
                 "semTahun": "2022",
                 "nmsemrNama": "Gasal"
             },
             "message": "sukses!"
         }

     */


        $link = $this->host . 'home/getSemesterAktif';

        $headers = [
            $this->auth_key => $this->auth_val,
            // 'User_Agent'=>$this->user_agent,
        ];

        $is_withContentType  = true;
        $is_withAuthToken = false;

        $data = [
            'nim' => $nim
        ];

        $this->salz_api->set_method('POST');
        $this->salz_api->set_host($link);
        $this->salz_api->set_header($headers, $is_withContentType, $is_withAuthToken);
        $this->salz_api->set_content_type($this->content_type);
        $this->salz_api->set_body($data);
        $result = $this->salz_api->exec();

        return $result;
    }

    public function get_jadwal($nim) {
        // With Auth Token

        /*
     $token = null
     $nim = nim untuk mahasiswa
     */

        /*
         Result


         {
             "code": 1,
             "data": [
                 {
                     "klsId": "340022727",
                     "is_kbk": "0",
                     "klsNama": "221181030303B C11",
                     "mkkurKode": "181030303",
                     "mkkurNamaResmi": "Arsitektur Komputer",
                     "ttpmukaMateri": "",
                     "kodeMetodeBelajar": "",
                     "namaMetodeBelajar": "",
                     "DOSEN_KELAS": "Hadi Utomo, M.EngSc",
                     "jdkulHari": "Senin",
                     "noDay": "1",
                     "jdkulTanggal": "",
                     "jdkulJamMulai": "18:30 WIB",
                     "jdkulJamSelesai": "21:00 WIB",
                     "ruKode": "RO-40",
                     "ruNama": "Online - No. 040",
                     "DOSEN_JADWAL": "",
                     "kelompok": "",
                     "list_kelompok": ""
                 },
                 {
                     "klsId": "340022705",
                     "is_kbk": "0",
                     "klsNama": "221181030306B D11",
                     "mkkurKode": "181030306",
                     "mkkurNamaResmi": "Komputer dan Masyarakat",
                     "ttpmukaMateri": "",
                     "kodeMetodeBelajar": "",
                     "namaMetodeBelajar": "",
                     "DOSEN_KELAS": "Quintin Kurnia Dikara",
                     "jdkulHari": "Selasa",
                     "noDay": "2",
                     "jdkulTanggal": "",
                     "jdkulJamMulai": "18:30 WIB",
                     "jdkulJamSelesai": "20:10 WIB",
                     "ruKode": "RO-37",
                     "ruNama": "Online - No. 037",
                     "DOSEN_JADWAL": "",
                     "kelompok": "",
                     "list_kelompok": ""
                 },
                 {
                     "klsId": "340022728",
                     "is_kbk": "0",
                     "klsNama": "221181030308B C13",
                     "mkkurKode": "181030308",
                     "mkkurNamaResmi": "Praktikum Algoritma dan Pemrograman II",
                     "ttpmukaMateri": "",
                     "kodeMetodeBelajar": "",
                     "namaMetodeBelajar": "",
                     "DOSEN_KELAS": "Harry T.Y. Achsan, M.Kom",
                     "jdkulHari": "Rabu",
                     "noDay": "3",
                     "jdkulTanggal": "",
                     "jdkulJamMulai": "18:30 WIB",
                     "jdkulJamSelesai": "21:00 WIB",
                     "ruKode": "RO-37",
                     "ruNama": "Online - No. 037",
                     "DOSEN_JADWAL": "",
                     "kelompok": "",
                     "list_kelompok": ""
                 },
                 {
                     "klsId": "340022729",
                     "is_kbk": "0",
                     "klsNama": "221181030304B C13",
                     "mkkurKode": "181030304",
                     "mkkurNamaResmi": "Bahasa Inggris II",
                     "ttpmukaMateri": "",
                     "kodeMetodeBelajar": "",
                     "namaMetodeBelajar": "",
                     "DOSEN_KELAS": "Ivonne Sartika Mangula, S.T.,M.Kom",
                     "jdkulHari": "Jumat",
                     "noDay": "5",
                     "jdkulTanggal": "",
                     "jdkulJamMulai": "18:30 WIB",
                     "jdkulJamSelesai": "20:10 WIB",
                     "ruKode": "RO-42",
                     "ruNama": "Online - No. 042",
                     "DOSEN_JADWAL": "",
                     "kelompok": "",
                     "list_kelompok": ""
                 },
                 {
                     "klsId": "340022723",
                     "is_kbk": "0",
                     "klsNama": "221181030307C C11",
                     "mkkurKode": "181030307",
                     "mkkurNamaResmi": "Matematika Komputer",
                     "ttpmukaMateri": "",
                     "kodeMetodeBelajar": "",
                     "namaMetodeBelajar": "",
                     "DOSEN_KELAS": "Mushliha, M.Si.",
                     "jdkulHari": "Sabtu",
                     "noDay": "6",
                     "jdkulTanggal": "",
                     "jdkulJamMulai": "07:00 WIB",
                     "jdkulJamSelesai": "09:30 WIB",
                     "ruKode": "Gedung D - D1-4",
                     "ruNama": "Lab Kom Game",
                     "DOSEN_JADWAL": "",
                     "kelompok": "",
                     "list_kelompok": ""
                 },
                 {
                     "klsId": "340022724",
                     "is_kbk": "0",
                     "klsNama": "221181030302C C11",
                     "mkkurKode": "181030302",
                     "mkkurNamaResmi": "Animasi",
                     "ttpmukaMateri": "",
                     "kodeMetodeBelajar": "",
                     "namaMetodeBelajar": "",
                     "DOSEN_KELAS": "Wirawan Noviana, M.T.I.",
                     "jdkulHari": "Sabtu",
                     "noDay": "6",
                     "jdkulTanggal": "",
                     "jdkulJamMulai": "09:45 WIB",
                     "jdkulJamSelesai": "12:15 WIB",
                     "ruKode": "Gedung D - D1-2",
                     "ruNama": "Lab Kom TI",
                     "DOSEN_JADWAL": "",
                     "kelompok": "",
                     "list_kelompok": ""
                 },
                 {
                     "klsId": "340022725",
                     "is_kbk": "0",
                     "klsNama": "221181030301C C13",
                     "mkkurKode": "181030301",
                     "mkkurNamaResmi": "Algoritma dan Pemrograman II",
                     "ttpmukaMateri": "",
                     "kodeMetodeBelajar": "",
                     "namaMetodeBelajar": "",
                     "DOSEN_KELAS": "Harry T.Y. Achsan, M.Kom",
                     "jdkulHari": "Sabtu",
                     "noDay": "6",
                     "jdkulTanggal": "",
                     "jdkulJamMulai": "12:45 WIB",
                     "jdkulJamSelesai": "15:15 WIB",
                     "ruKode": "CL D3-4",
                     "ruNama": "Gedung D - No 304",
                     "DOSEN_JADWAL": "",
                     "kelompok": "",
                     "list_kelompok": ""
                 },
                 {
                     "klsId": "340022726",
                     "is_kbk": "0",
                     "klsNama": "221181030305C C11",
                     "mkkurKode": "181030305",
                     "mkkurNamaResmi": "Jaringan Komputer",
                     "ttpmukaMateri": "",
                     "kodeMetodeBelajar": "",
                     "namaMetodeBelajar": "",
                     "DOSEN_KELAS": "Andi Hasad, ST, M.Kom",
                     "jdkulHari": "Sabtu",
                     "noDay": "6",
                     "jdkulTanggal": "",
                     "jdkulJamMulai": "15:30 WIB",
                     "jdkulJamSelesai": "18:00 WIB",
                     "ruKode": "Gedung D - D1-4",
                     "ruNama": "Lab Kom Game",
                     "DOSEN_JADWAL": "",
                     "kelompok": "",
                     "list_kelompok": ""
                 }
             ],
             "message": "sukses!"
         }

     */


        $link = $this->host . 'home/get_jadwal';

        $headers = [
            $this->auth_key => $this->auth_val,
            // 'User_Agent'=>$this->user_agent,
        ];

        $is_withContentType  = true;
        $is_withAuthToken = false;

        $data = [
            'nim' => $nim
        ];

        $this->salz_api->set_method('POST');
        $this->salz_api->set_host($link);
        $this->salz_api->set_header($headers, $is_withContentType, $is_withAuthToken);
        $this->salz_api->set_content_type($this->content_type);
        $this->salz_api->set_body($data);
        $result = $this->salz_api->exec();

        return $result;
    }

    public function get_peserta_kelas($kelas_id) {
        // With Auth Token

        /*
     $kelas_id = kelas_id didapat dari method get_jadwal
     */

        /*

     Result

     {
         "code": 1,
         "data": [
             {
                 "nim": "121203003",
                 "nama": "Adnan Nuur Bachtiar",
                 "prodi": "PTI",
                 "noHandphone": "081289148054",
                 "angkatan": "2021",
                 "foto": "scaled_image_picker6215085894398276553.jpg"
             },
             {
                 "nim": "121203011",
                 "nama": "Akrom Hafifi",
                 "prodi": "PTI",
                 "noHandphone": "085624421032",
                 "angkatan": "2021",
                 "foto": "scaled_image_picker4429096151695553807.jpg"
             },
             {
                 "nim": "121103025",
                 "nama": "Bagas Saputra",
                 "prodi": "PTI",
                 "noHandphone": "08551998507",
                 "angkatan": "2021",
                 "foto": "scaled_image_picker8098226288056490752.jpg"
             },
             {
                 "nim": "121103026",
                 "nama": "Daeng Ahmad Nurdin",
                 "prodi": "PTI",
                 "noHandphone": "089635572028",
                 "angkatan": "2021",
                 "foto": "scaled_image_picker7428885337825835121.jpg"
             },
             {
                 "nim": "121103018",
                 "nama": "Dodik Firmansah",
                 "prodi": "PTI",
                 "noHandphone": "08995871002",
                 "angkatan": "2021",
                 "foto": "scaled_image_picker2196307682501046061.jpg"
             },
             {
                 "nim": "121103005",
                 "nama": "Erwindiaztama",
                 "prodi": "PTI",
                 "noHandphone": "081291360063",
                 "angkatan": "2021",
                 "foto": "image_picker_0152C288-234F-4B45-83B1-F33FAE52371D-5043-00000176163EED10.jpg"
             },
             {
                 "nim": "120103042",
                 "nama": "Faizhal Aji Dewanta Putra",
                 "prodi": "PTI",
                 "noHandphone": "081216176820",
                 "angkatan": "2020",
                 "foto": ""
             },
             {
                 "nim": "121103028",
                 "nama": "Micko Wiyono Rohman Soleh",
                 "prodi": "PTI",
                 "noHandphone": "085881849757",
                 "angkatan": "2021",
                 "foto": "scaled_image_picker5547106845557402961.jpg"
             },
             {
                 "nim": "121203006",
                 "nama": "Mochammad Faisal",
                 "prodi": "PTI",
                 "noHandphone": "087776088441",
                 "angkatan": "2021",
                 "foto": "scaled_image_picker8984173453504766501.jpg"
             },
             {
                 "nim": "121103004",
                 "nama": "Muhamad Ilham Fauzan",
                 "prodi": "PTI",
                 "noHandphone": "083806913158",
                 "angkatan": "2021",
                 "foto": "scaled_image_picker8951566073307650360.jpg"
             },
             {
                 "nim": "121103011",
                 "nama": "Sri Alia Rosidah",
                 "prodi": "PTI",
                 "noHandphone": "087893210709",
                 "angkatan": "2021",
                 "foto": "scaled_bd8bb702-b3ae-4050-830a-37cb655a780f5289252422401444064.jpg"
             },
             {
                 "nim": "121103024",
                 "nama": "Yanuar Eka Saputra",
                 "prodi": "PTI",
                 "noHandphone": "082112046941",
                 "angkatan": "2021",
                 "foto": "scaled_image_picker890896041909514838.jpg"
             }
         ],
         "message": "sukses!"
     }

     */


        $link = $this->host . 'home/get_peserta_kelas';

        $headers = [
            $this->auth_key => $this->auth_val,
            // 'User_Agent'=>$this->user_agent,
        ];

        $is_withContentType  = true;
        $is_withAuthToken = false;

        $data = [
            // 'token'=>'',
            'kelas_id' => $kelas_id
        ];

        $this->salz_api->set_method('POST');
        $this->salz_api->set_host($link);
        $this->salz_api->set_header($headers, $is_withContentType, $is_withAuthToken);
        $this->salz_api->set_content_type($this->content_type);
        $this->salz_api->set_body($data);
        $result = $this->salz_api->exec();

        return $result;
    }

    function get_forum_diskusi_kelas($kelas_id) {
        // With Auth Token
        $link = $this->host . 'home/getForumChat';

        $headers = [
            // $this->auth_key => $this->auth_val,
            // 'User_Agent'=>$this->user_agent,
        ];

        $is_withContentType  = true;
        $is_withAuthToken = true;

        $data = [
            'kelasid' => $kelas_id
        ];


        $this->salz_api->set_method('POST');
        $this->salz_api->set_host($link);
        $this->salz_api->set_header($headers, $is_withContentType, $is_withAuthToken);
        $this->salz_api->set_content_type($this->content_type);
        $this->salz_api->set_body($data);
        $result = $this->salz_api->exec();

        return $result;
    }

    public function get_dosen() {
        // Without Auth Token

        /*

     Result

    {
     "code": 1,
         "data": [
             {
                 "pegNip": "ARU",
                 "pegNama": "Aan Rukmana",
                 "pegJenisKelaminKode": "L",
                 "pegAlamatRumah": "Jl. Bb Rt/Rw. 007/005 Tegal Parang, Mampang Prapatan Jakarta Selatan",
                 "pegStatusDosen": "DT",
                 "pegIsAktif": "1",
                 "pegEmail": "aan.rukmana@paramadina.ac.id",
                 "foto": "ARU.jpg"
             },
             ],
         "message": "sukses!"
     }

     */


        $link = $this->host . 'home/get_dosen';

        $headers = [
            // $this->auth_key => $this->auth_val,
            // 'User_Agent'=>$this->user_agent,
        ];

        $is_withContentType  = false;
        $is_withAuthToken = true;

        $data = [
            // 'kelas_id' => $kelas_id
        ];

        $this->salz_api->set_method('GET');
        $this->salz_api->set_host($link);
        $this->salz_api->set_header($headers, $is_withContentType, $is_withAuthToken);
        $this->salz_api->set_content_type($this->content_type);
        $this->salz_api->set_body($data);
        $result = $this->salz_api->exec();

        return $result;
    }

    function get_khs($nim, $semester) {
        // With Auth Token
        $link = $this->host . 'home/get_khs';

        $headers = [
            // $this->auth_key => $this->auth_val,
            // 'User_Agent'=>$this->user_agent,
        ];

        $is_withContentType  = true;
        $is_withAuthToken = true;

        $data = [
            'nim' => $nim,
            'semester' => $semester,
        ];


        $this->salz_api->set_method('POST');
        $this->salz_api->set_host($link);
        $this->salz_api->set_header($headers, $is_withContentType, $is_withAuthToken);
        $this->salz_api->set_content_type($this->content_type);
        $this->salz_api->set_body($data);
        $result = $this->salz_api->exec();

        return $result;
    }

    function get_semester($nim) {
        // With Auth Token
        $link = $this->host . 'home/get_semester';

        $headers = [
            // $this->auth_key => $this->auth_val,
            // 'User_Agent'=>$this->user_agent,
        ];

        $is_withContentType  = true;
        $is_withAuthToken = true;

        $data = [
            'nim' => $nim,
        ];


        $this->salz_api->set_method('POST');
        $this->salz_api->set_host($link);
        $this->salz_api->set_header($headers, $is_withContentType, $is_withAuthToken);
        $this->salz_api->set_content_type($this->content_type);
        $this->salz_api->set_body($data);
        $result = $this->salz_api->exec();

        return $result;
    }

    function get_gsuite_email($nim) {
        // With Auth Token
        $link = $this->host . 'home/getSuite';

        $headers = [
            // $this->auth_key => $this->auth_val,
            // 'User_Agent'=>$this->user_agent,
        ];

        $is_withContentType  = true;
        $is_withAuthToken = true;

        $data = [
            'username' => $nim,
        ];


        $this->salz_api->set_method('POST');
        $this->salz_api->set_host($link);
        $this->salz_api->set_header($headers, $is_withContentType, $is_withAuthToken);
        $this->salz_api->set_content_type($this->content_type);
        $this->salz_api->set_body($data);
        $result = $this->salz_api->exec();

        return $result;
    }
}
