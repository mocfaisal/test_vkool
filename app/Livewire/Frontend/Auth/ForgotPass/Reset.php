<?php

namespace App\Livewire\Frontend\Auth\ForgotPass;

use Livewire\Component;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class Reset extends Component {
    public $email;
    public $password;
    public $password_confirmation;
    public $token;

    public function render() {
        return view('livewire.frontend.auth.forgot-pass.reset')
            ->layout("layouts.frontend.auth.mainLayout");
    }

    function mount($token, Request $request) {
        $this->token = $token;
        $this->email = $request->input('email');
    }

    function processChangePass() {
        $this->skipRender();

        // $request->validate([
        //     'token' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required|min:8|confirmed',
        // ]);

        $dataArr = [
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token' => $this->token,
        ];

        $status = Password::reset(
            $dataArr,
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            $r = ['success' => true, 'msg' => __($status), 'uri' => route('auth.login')];
        } else {
            $r = ['success' => false, 'msg' => __($status)];
        }

        $this->dispatch('showResult', result: $r);
    }
}
