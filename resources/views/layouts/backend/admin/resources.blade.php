{{-- File Resources --}}
@section('global.resources.head')
    {{-- blade-formatter-disable --}}


<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/choices.js/public/assets/styles/choices.css" data-navigate-once>
<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/select2/css/select2.min.css" data-navigate-once>
<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/select2/css/select2-bootstrap-5-theme.min.css" data-navigate-once>
<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/@fortawesome/fontawesome-free/css/all.min.css" data-navigate-once>
<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/sweetalert2/sweetalert2.min.css" data-navigate-once>

{{-- <link rel="stylesheet" href="{{ asset('assets/backend') }}/compiled/css/app.css" data-navigate-once> --}}
{{-- <link rel="stylesheet" href="{{ asset('assets/backend') }}/compiled/css/app-dark.css" data-navigate-once> --}}

{{-- <script src="{{ asset('assets/backend') }}/static/js/initTheme.js" data-navigate-once></script> --}}

<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css" data-navigate-once>
<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/DataTables/datatables.min.css" data-navigate-once>
<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/jquery-ui/jquery-ui.min.css" data-navigate-once>
<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/jquery-ui/jquery-ui.theme.min.css" data-navigate-once>
<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/flatpickr/flatpickr.min.css" data-navigate-once>
<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css" data-navigate-once>
<link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/datetimepicker/css/tempus-dominus.min.css" data-navigate-once>

{{-- <link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/filepond/filepond.min.css" data-navigate-once> --}}
{{-- <link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css" data-navigate-once> --}}

@endsection


@section('global.resources.footer')

{{-- <script src="{{ asset('assets/backend') }}/static/js/components/dark.js" data-navigate-once></script> --}}
<script src="{{ asset('assets/backend') }}/extensions/perfect-scrollbar/perfect-scrollbar.min.js" data-navigate-once></script>
{{-- <script src="{{ asset('assets/backend') }}/compiled/js/app.js" data-navigate-once></script> --}}

<script src="{{ asset('assets/backend') }}/extensions/sweetalert2/sweetalert2.min.js" data-navigate-once></script>

<script src="{{ asset('assets/backend') }}/extensions/jquery/jquery.min.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/jquery-ui/jquery-ui.min.js" data-navigate-once></script>

<script src="{{ asset('assets/backend/custom') }}/salz.js" data-navigate-once></script>

<script src="{{ asset('assets/backend') }}/extensions/parsleyjs/parsley.min.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/choices.js/public/assets/scripts/choices.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/select2/js/select2.full.min.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/DataTables/datatables.min.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/flatpickr/flatpickr.min.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/jquery-Mask/jquery.mask.min.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/bootstrap-datepicker/js/bootstrap-datepicker.min.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/datetimepicker/js/popper.min.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/datetimepicker/js/tempus-dominus.min.js" data-navigate-once></script>
{{-- <script src="{{ asset('assets/backend') }}/extensions/datetimepicker/js/jQuery-provider.min.js" data-navigate-once></script> --}}

{{-- Filepond --}}
{{-- <script src="{{ asset('assets/backend') }}/extensions/filepond/filepond.min.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/filepond/filepond.jquery.js" data-navigate-once></script>
<script src="{{ asset('assets/backend') }}/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js" data-navigate-once> </script>
<script src="{{ asset('assets/backend') }}/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js" data-navigate-once> </script>
<script src="{{ asset('assets/backend') }}/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js" data-navigate-once> </script>
<script src="{{ asset('assets/backend') }}/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js" data-navigate-once> </script>
<script src="{{ asset('assets/backend') }}/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js" data-navigate-once> </script>
<script src="{{ asset('assets/backend') }}/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js" data-navigate-once> </script>
<script src="{{ asset('assets/backend') }}/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js" data-navigate-once> </script> --}}

<script src="{{ asset('assets/backend') }}/static/js/pages/parsley.js" data-navigate-once></script>
@endsection

{{-- blade-formatter-enable --}}

    {{-- Code Resources --}}
@section('global.css.code')
    <style type="text/css">
        .ui-autocomplete {
            position: absolute;
            z-index: 1000;
            cursor: default;
            padding: 0;
            margin-top: 2px;
            list-style: none;
            background-color: #ffffff;
            border: 1px solid #ccc;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .ui-autocomplete>li {
            padding: 3px 20px;
        }

        .ui-autocomplete>li.ui-state-focus {
            background-color: #DDD;
        }

        .ui-helper-hidden-accessible {
            display: none;
        }

        .ui-menu {}

        .ui-menu-item:hover {
            color: #fff;
            background: #007FFF;
        }

        .ui-front {
            z-index: 9999;
        }

        .choices__inner {
            background-color: unset;
        }

        .form-control:read-only {
            background-color: #e9ecef;
        }
    </style>
@endsection

@section('global.javascript.footer')

    {{-- <script data-navigate-once>
    document.addEventListener('livewire:init', () => {
        // Runs after Livewire is loaded but before it's initialized
        // on the page...
        console.log('livewire before init');
        @yield('global.livewire.js.before.init')
    });

    document.addEventListener('livewire:initialized', () => {
        // Runs immediately after Livewire has finished initializing
        // on the page...
        console.log('livewire after init');
        @yield('global.livewire.js.after.init')
    });

    document.addEventListener('livewire:load', () => {
        console.log('livewire load js code');

        @yield('global.livewire.js.load.init')

    });
</script> --}}

    <script data-navigate-once>
        document.addEventListener('livewire:initialized', () => {
            // NOTE Reinitialize Sidebar
            const sidebar = new window.Sidebar(document.getElementById("sidebar"), {
                recalculateHeight: true
            })
        });

        document.addEventListener('livewire:navigated', () => {
            // NOTE Reinitialize Sidebar
            const sidebar = new window.Sidebar(document.getElementById("sidebar"), {
                recalculateHeight: true
            })
        });
    </script>

    <script data-navigate-once>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const Swal2 = Swal.mixin({
            customClass: {
                input: 'form-control'
            }
        });

        // Choices
        let choices = document.querySelectorAll(".choices")
        let initChoice
        for (let i = 0; i < choices.length; i++) {
            if (choices[i].classList.contains("multiple-remove")) {
                initChoice = new Choices(choices[i], {
                    delimiter: ",",
                    editItems: true,
                    maxItemCount: -1,
                    removeItemButton: true,
                })
            } else {
                initChoice = new Choices(choices[i])
            }
        }

        // Select2
        $('.select2').select2({
            theme: 'bootstrap-5',
            minimumInputLength: -1,
            allowClear: true,
            placeholder: "Select..."
        });

        // FilePond
        // FilePond.registerPlugin(
        //     FilePondPluginImagePreview,
        //     FilePondPluginImageExifOrientation,
        //     FilePondPluginFileValidateSize,
        //     FilePondPluginFileValidateType
        // );
    </script>

    <script data-navigate-once>
        function popResult(table, response) {
            let res = response.result;

            if (res.success) {
                Swal.fire({
                    title: 'Success',
                    text: res.msg,
                    icon: 'success',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {}
                    table.ajax.reload();
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: res.msg,
                    icon: 'error',
                });
            }
        }

        function popResult2(response) {
            let res = response.result;

            if (res.success) {
                Swal.fire({
                    title: "{{ __('custom.swal.title.success') }}",
                    text: res.msg,
                    icon: 'success',
                    confirmButtonText: "{{ __('custom.swal.button.ok') }}",
                }).then((result) => {
                    if (result.isConfirmed) {}
                    if (res.uri) {
                        window.location.href = res.uri;
                    } else {
                        window.location.reload();
                    }
                });
            } else {
                Swal.fire({
                    title: "{{ __('custom.swal.title.error') }}",
                    text: res.msg,
                    icon: 'error',
                });
            }
        }

        window.showActive = function(active_link = null) {
            // NOTE Reff : https://github.com/livewire/livewire/discussions/6043#discussioncomment-7008926
            // NOTE not tested for level-2 submenu
            // FIXME there is bug when refreshed page & on another menu like create, edit, detail. showing error on console

            active_link = active_link ?? document.URL.split(/[?#]/)[0];
            document.querySelectorAll('.sidebar-menu ul a').forEach(function(item) {
                if (active_link == item.getAttribute("href") && (active_link != 'javascript:void(0);' &&
                        active_link != '#')) {
                    item.parentNode.classList.add('active');
                    item.parentNode.parentNode.parentNode.classList.add('active');

                } else {
                    item.parentNode.classList.remove('active')
                }
            });
        };

        document.querySelectorAll('.sidebar-menu ul a').forEach(element => element.addEventListener('click', e => {
            showActive(element.getAttribute("href"));
        }));

        function initTooltipsBS() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="true"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        }

        window.showActive();
    </script>
@endsection
