<?php

namespace App\Livewire\Frontend\Auth;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Livewire\Attributes\Validate;

class Register extends Component {

    #[Validate('required')]
    public $fullname;
    #[Validate('required')]
    public $email;
    #[Validate('required')]
    public $password;
    #[Validate('required')]
    public $password_confirmation;

    // public $token;


    public function render() {
        return view('livewire.frontend.auth.register')
            ->layout("layouts.frontend.auth.mainLayout");
    }

    function mount() {
    }

    function processRegister() {
        // $this->skipRender();
        $this->validate();

        $fullname = $this->fullname;
        $email = $this->email;
        $password = $this->password;
        $password_confirmation = $this->password_confirmation;

        // NOTE Validate
        if ($password != $password_confirmation) {
            $r = ['success' => false, 'msg' => 'Password tidak sama'];
            $this->dispatch('showResult', result: $r);
            return;
        }

        // Check if email already registered
        $user = User::where('email', $email)->first();

        if ($user) {
            $r = ['success' => false, 'msg' => 'Email sudah terdaftar'];
            $this->dispatch('showResult', result: $r);
            return;
        }

        // NOTE Register User
        $password_enc = Hash::make($password);

        $datasave = [
            'fullname' => $fullname,
            'email' => $email,
            'password' => $password_enc,
        ];

        $user = User::create($datasave);
        if ($user) {
            $r = ['success' => true, 'msg' => 'Registrasi berhasil, silahkan login', 'uri' => route('auth.login')];
        } else {
            $r = ['success' => false, 'msg' => 'Registrasi gagal'];
        }

        $this->dispatch('showResult', result: $r);
    }
}
