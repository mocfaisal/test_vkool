{{-- File Resources --}}
@section('global.resources.head')
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/extensions/sweetalert2/sweetalert2.min.css" data-navigate-once>
@endsection

@section('global.resources.footer')
    <script src="{{ asset('assets/backend') }}/extensions/sweetalert2/sweetalert2.min.js" data-navigate-once></script>

    <script src="{{ asset('assets/backend') }}/extensions/jquery/jquery.min.js" data-navigate-once></script>
@endsection

{{-- Code Resources --}}
@section('global.css.code')
    <style type="text/css">

    </style>
@endsection

@section('global.javascript.footer')
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

        // $('.select2').select2({
        //     minimumInputLength: -1,
        //     allowClear: true,
        // });
    </script>

    <script data-navigate-once>
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
                });
            } else {
                Swal.fire({
                    title: "{{ __('custom.swal.title.error') }}",
                    text: res.msg,
                    icon: 'error',
                });
            }
        }

        function popResult3(response) {
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

        function popResult4(response) {
            let res = response.result;

            if (res.success) {
                if (res.uri) {
                    window.location.href = res.uri;
                }
            } else {
                Swal.fire({
                    title: "{{ __('custom.swal.title.error') }}",
                    text: res.msg,
                    icon: 'error',
                });
            }
        }
    </script>
@endsection
