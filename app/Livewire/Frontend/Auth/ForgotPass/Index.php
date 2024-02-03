<?php

namespace App\Livewire\Frontend\Auth\ForgotPass;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class Index extends Component {
    public $email;

    public function render() {
        return view('livewire.frontend.auth.forgot-pass.index')
            ->layout("layouts.frontend.auth.mainLayout");
    }

    function mount() {
    }

    function processEmail() {
        $this->skipRender();
        // NOTE Send Reset Link to Email
        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $r = ['success' => true, 'msg' => 'Link reset password telah dikirim ke email anda'];
        } else {
            $r = ['success' => false, 'msg' => __($status)];
        }

        $this->dispatch('showResult', result: $r);
    }
}
