<?php

namespace App\Livewire\Frontend\Auth;

use Livewire\Component;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\IpUtils;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Http;
use Auth;
use Session;
// use App\Models\MahasiswaModel;

class Login extends Component {
    public $username;
    public $password;
    public $google_recaptha_key;
    public $google_recaptha_secret;
    public $captcha = null;

    private $MahasiswaModel;

    public function render() {
        return view('livewire.frontend.auth.login')
            ->layout("layouts.frontend.auth.mainLayout");
    }

    function mount() {
        $this->google_recaptha_key = config('appConfig.thirdparty.google.recaptha.key');
        $this->google_recaptha_secret = config('appConfig.thirdparty.google.recaptha.secret');
        // $this->MahasiswaModel = new MahasiswaModel();
    }

    // validate the captcha rule
    protected function rules() {
        return [
            'captcha' => ['required'],
            // ...
        ];
    }

    function processLogin(Request $request) {
        $this->skipRender();
        $username = $this->username;
        $password = $this->password;
        // $recaptcha_response = $request->input('g-recaptcha-response');

        // dd($email, $password);

        // $this->validate($request, [
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);
        // $is_capcha_valid = $this->validateCaptcha($recaptcha_response);
        // $is_capcha_valid = $this->updatedCaptcha($recaptcha_response);

        // if (!$this->captcha) {
        //     $r = ['success' => false, 'msg' => 'Mohon centang captcha terlebih dahulu atau muat ulang halaman'];
        //     $this->dispatch('showResult', result: $r);
        //     return;
        // }

        $is_auth = Auth::attempt(['username' => $username, 'password' => $password]);

        if ($is_auth) {
            $user_data = Auth::user();

            $id_profile = $user_data->id_profile;
            $user_id = $user_data->id;
            $user_name = $user_data->name;
            $user_nim = null;
            $id_role = $user_data->id_role;

            // Get Data Mahasiswa
            // $data_mahasiswa = $this->MahasiswaModel->get_profile_mhs($id_profile);
            // $user_nim = $data_mahasiswa->username;

            // Set Session
            Session::put('user_id', $user_id);
            Session::put('user_role_txt', 'Administrator');
            Session::put('user_fullname', $user_name);
            Session::put('user_nim', $user_nim);

            // Redirect to route
            // return redirect()->route('backend.admin.home');
            $r = ['success' => true, 'msg' => 'Berhasil Login', 'uri' => route('backend.admin.home')];
        } else {
            $r = ['success' => false, 'msg' => 'Username atau Password salah'];
        }

        // dispatch to current js function
        $this->dispatch('showResult', result: $r);
    }

    public function updatedCaptcha($token) {
        // NOTE REFF : https://coderflex.com/blog/enhancing-security-and-user-experience-leveraging-recaptcha-with-laravel-and-livewire#step-9-add-google-recaptcha
        // NOTE Using V2 Google Recaptcha

        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . $this->google_recaptha_secret . '&response=' . $token);
        $success = $response->json()['success'];

        if (!$success) {
            $this->captcha = false;
            // return  ['success' => false, 'msg' => 'Google thinks you are a bot, please refresh and try again'];
        } else {
            $this->captcha = true;
            // return  ['success' => true, 'msg' => 'Captcha Validated'];
        }
    }

    function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
