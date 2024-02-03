<div>
    {{-- Root div must be added --}}

    @section('private.css.file')
    <script src="https://www.google.com/recaptcha/api.js?onload=handle&render=explicit" async defer> </script>
    @endsection

    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        {{-- <img src="assets/static/images/logo/logo.svg" alt="Logo"> --}}
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                    <form wire:submit="processLogin">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username"
                                wire:model="username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password"
                                wire:model="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        {{-- <div class="mt-4" id="captcha" wire:ignore></div> --}}

                        <button type="submit" class="btn btn-primary btn-block btn-lg mt-5 shadow-lg">Log in</button>
                    </form>
                    {{-- <div class="fs-4 mt-5 text-center text-lg">
                        <p class="text-gray-600">Don't have an account? <a class="font-bold" href="{{ route('auth.register') }}" wire:navigate>Sign up</a>.</p>
                        <p><a class="font-bold" href="{{ route('auth.forgot_pass') }}" wire:navigate>Forgot password?</a>.</p>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>
    </div>

</div>

@section('private.js.code')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('showResult', (response) => popResult4(response));
        });

        document.addEventListener('livewire:navigated', () => {
            Livewire.on('showResult', (response) => popResult4(response));
        });
    </script>

    <script data-navigate-once>
        var handle = function(e) {
            widget = grecaptcha.render('captcha', {
                'sitekey': '{{ $google_recaptha_key }}',
                'theme': 'light', // you could switch between dark and light mode.
                'callback': verify
            });

        }
        var verify = function(response) {
            @this.set('captcha', response)
        }
    </script>
@endsection
