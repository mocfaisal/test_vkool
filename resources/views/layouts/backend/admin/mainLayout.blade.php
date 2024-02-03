@include('layouts.backend.admin.resources')
@include('layouts.backend.admin.header')

<body>
    <div id="app">

        @include('layouts.backend.admin.sidebar')

        <div class='layout-navbar navbar-fixed' id="main">

            <div wire:ignore x-ignore>
                @include('layouts.backend.admin.navbar')
            </div>

            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>@yield('content.header.title')</h3>
                                {{-- <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p> --}}
                            </div>
                            {{-- <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav class="breadcrumb-header float-start float-lg-end" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Layout Vertical Navbar
                                        </li>
                                    </ol>
                                </nav>
                            </div> --}}
                        </div>
                    </div>

                    <section class="section">
                        {{-- @yield("content") --}}
                        {{ $slot }}
                    </section>

                </div>

            </div>

            @include('layouts.backend.admin.footer')

        </div>
    </div>
    @yield('modal')
    @yield('global.resources.footer')
    @yield('global.javascript.footer')
    @yield('private.js.file')
    @yield('private.js.code')

    @stack('scripts')

    {{-- @livewireScripts --}}
</body>

</html>
