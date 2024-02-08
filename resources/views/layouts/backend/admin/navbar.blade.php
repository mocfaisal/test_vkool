<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a class="burger-btn d-block" href="javascript:void(0)">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-lg-0 ms-auto">

                </ul>
                <div class="dropdown">
                    <a data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name me-3 text-end">
                                <h6 class="mb-0 text-gray-600">{{ Session::get('user_fullname') }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ Session::get('email') }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ asset('assets/backend') }}/compiled/jpg/1.jpg">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ Session::get('user_fullname') }}!</h6>
                        </li>
                        <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('auth.logout') }}" wire:navigate><i
                                    class="icon-mid bi bi-box-arrow-left me-2"></i>
                                Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
