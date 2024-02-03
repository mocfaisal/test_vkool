@include('layouts.frontend.auth.resources')
@include('layouts.frontend.auth.header')

<body>
    <div>
        {{-- @yield('content') --}}
        {{ $slot }}
    </div>

    @include('layouts.frontend.auth.footer')

    @yield('modal')
    @yield('global.resources.footer')
    @yield('global.javascript.footer')
    @yield('private.js.file')
    @yield('private.js.code')

    @stack('scripts')

</body>

</html>
