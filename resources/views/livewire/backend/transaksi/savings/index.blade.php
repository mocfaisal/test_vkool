@section('app.title', 'Savings')
@section('content.header.title', 'Savings')

@section('private.css.code')

    <style>
        /* .progress .progress-bar.progress-label:before {
                                right: -40px;
                            } */
        .bordered {
            /* border: unset; */
        }
    </style>

@endsection

<div>
    {{-- Root div must be added --}}

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h4 class="card-title">List Data Tabungan Masa Depan</h4>
            </div>
            <div class="float-end">
                <div class="buttons">
                    <a class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#mdl_saving"><i
                            class="bi bi-plus"></i> Add Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="row justify-content-start">
                <div class="col-3" wire:ignore>
                    <div class="form-group">
                        <label for="search_status">Status</label>
                        <select class="form-select" id="search_status" wire:model="search_status" style="width:100%;"
                            wire:ignore>
                            <option value="">-- Pilih Status --</option>
                            <option value="1">Sudah Tercapai</option>
                            <option value="0" selected>Masih Proses</option>
                        </select>
                        @error('search_status')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label></label>
                        <div class="buttons">
                            <button type="button" class="btn btn-success icon icon-left" id="btn_search">Cari <i
                                    class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                @if ($this->listData)
                    @foreach ($this->listData as $data)
                        <div class="col-xl-4 col-md-6 col-sm-12" wire:key="{{ $data->id }}">
                            <div class="card bordered border-success">
                                <div class="card-content"
                                    wire:click="$dispatch('popSaving', {id_saving: {{ $data->id }}})">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $data->judul }}</h4>

                                        <table border="0">
                                            <tbody>
                                                <tr>
                                                    <td>Target</td>
                                                    <td>:</td>
                                                    <td>Rp. {{ $data->nominal_target }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tercapai</td>
                                                    <td>:</td>
                                                    <td>Rp. {{ $data->nominal_total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <br>

                                        <div class="progress progress-info">
                                            <div class="progress-bar progress-label"
                                                title="Rp. {{ $data->nominal_total }}" role="progressbar"
                                                style="width: {{ $data->capaian_persen }}%"
                                                aria-valuenow="{{ $data->capaian_persen }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <div class="btn-group">
                                        <button class="btn icon btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#mdl_saving" title="Edit"
                                            wire:click="$dispatch('edit-mode', {id: {{ $data->id }}})"><i
                                                class="bi bi-pencil"></i></button>
                                        <button class="btn icon btn-danger" title="Hapus"
                                            onclick="popDelete({{ $data->id }})""><i class="bi bi-x"></i></button>
                                        <button class="btn btn-light-primary" data-bs-toggle="modal"
                                            data-bs-target="#mdl_saving_pop_detail" title="Detail"
                                            wire:click="$dispatch('detail-mode', {id: {{ $data->id }}})"><i
                                                class="bi bi-info-circle-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

            <div class="float-end">
                {{ $this->listData->links() }}
            </div>

        </div>
        <div class="card-footer">
            <div class="text-muted">
                {{-- <span>*Status Display is showed on footer of page</span> --}}
            </div>
        </div>

    </div>

    <livewire:backend.transaksi.savings.create>
        <livewire:backend.transaksi.savings.pop-add>
            <livewire:backend.transaksi.savings.pop-detail>

</div>

{{-- Resources --}}
{{-- External Code --}}
@section('private.css.file')

@endsection

@section('private.js.file')

@endsection

{{-- Internal Code --}}
@section('private.css.code')

@endsection

@section('private.js.code')

    <script>
        // Variable Declare
        var date_range = null;

        // Function Declare

        function popDelete(id) {
            Swal.fire({
                title: "{{ __('custom.swal.title.confirm', ['first' => 'delete', 'second' => 'data']) }}",
                showDenyButton: true,
                confirmButtonText: "{{ __('custom.swal.button.yes') }}",
                denyButtonText: "{{ __('custom.swal.button.no') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('destroy', id);
                }
            })
        }

        function popStatus(id, stat) {
            Swal.fire({
                title: "{{ __('custom.swal.title.confirm', ['first' => 'update', 'second' => 'status']) }}",
                showDenyButton: true,
                confirmButtonText: "{{ __('custom.swal.button.yes') }}",
                denyButtonText: "{{ __('custom.swal.button.no') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('update_status', id, stat);
                }
            })
        }

        function initMasking() {
            $('.mask-nominal').mask("#,##0", {
                reverse: true
            });
        }

        // On Event
        $('#btn_search').on('click', function() {
            var status_search = $('#search_status').val();

            @this.call('getData', {
                search_status: status_search,
            });

        });

        // initial function
        date_range = flatpickr('.flatpickr', {
            altInput: true,
            altFormat: "d F Y",
            dateFormat: "Y-m-d",
            mode: 'range',
            maxDate: "today",
            wrap: true,
            position: "auto center",
        });

        $('#search_status').select2({
            theme: 'bootstrap-5',
            minimumInputLength: -1,
            allowClear: true,
            placeholder: "-- Pilih Status --"
        }).on("change", function(e) {
            // @this.set('search_status', e.target.value);
        });

        initMasking();
    </script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            // var mymodal = document.getElementById('mdl_saving');
            var myModalEl = document.querySelector('#mdl_saving')
            var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)


            // Listen to dispatch from server
            @this.on('showResult', (response) => {
                popResult2(response);
                modal.hide();
            });
        });

        document.addEventListener('livewire:navigated', () => {
            // console.log('livewire load code when navigated');
            // Listen to dispatch from server
            Livewire.on('showResult', (response) => popResult2(response));
        });

        document.addEventListener('livewire:navigating', () => {
            // Mutate the HTML before the page is navigated away...
        });

        // Fix render issue when browser back button pressed
        // reff : https://github.com/livewire/livewire/discussions/6722#discussioncomment-6946058
        window.addEventListener("popstate", function(event) {
            window.location.reload();
        });
    </script>
@endsection
