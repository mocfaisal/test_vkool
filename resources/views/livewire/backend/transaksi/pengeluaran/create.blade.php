@section('app.title', 'Pengeluaran')
@section('content.header.title', 'Pengeluaran')

@php

    $classState = '';
    $classFeedbackState = '';

    if ($errors->any()) {
        $classState = 'is-invalid';
        $classFeedbackState = 'invalid-feedback';
    }

@endphp

<div>
    {{-- Root div must be added --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Data</h4>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <div class="form-body">

                        <form wire:submit="save">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="input_title">Judul</label>
                                        <input type="text"
                                            class="form-control @error('input_title')  {{ $classState }} @enderror"
                                            name="input_title" placeholder="Judul Transaksi"
                                            wire:model.blur="input_title" required>

                                        @error('input_title')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12" wire:ignore>
                                    <div class="form-group">
                                        <label for="input_nominal">Nominal</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text"
                                                class="form-control mask-nominal @error('input_nominal')  {{ $classState }} @enderror"
                                                name="input_nominal" placeholder="Nominal"
                                                wire:model.live="input_nominal" wire:change="updateSumNominal" required>

                                            @error('input_nominal')
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-12" wire:ignore>
                                            <div class="form-group">
                                                <label for="input_wallet">Sumber Dana</label>
                                                <select class="form-select" id="input_wallet" style="width:100%;"
                                                    wire:model="input_wallet" required>
                                                    @foreach ($list_wallet as $wallet)
                                                        <option value="{{ $wallet['id'] }}">
                                                            {{ $wallet['nama'] }}</option>
                                                    @endforeach
                                                </select>

                                                @error('input_wallet')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12" wire:ignore>
                                            <div class="form-group">
                                                <label for="input_date">Tanggal Transaksi</label>
                                                <div class="input-group input_date">
                                                    <input type="text" class="form-control" id="input_date"
                                                        data-input placeholder="Pilih tanggal transaksi"
                                                        wire:model="input_date" required>

                                                    @error('input_date')
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                    <div class="btn-group">
                                                        <button type="button" class="btn input-button" data-toggle
                                                            title="toggle">
                                                            <i class="bi bi-calendar"></i>
                                                        </button>

                                                        <button type="button" class="btn input-button" data-clear
                                                            title="clear">
                                                            <i class="bi bi-x-lg"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="input_note">Catatan</label>
                                                <textarea class="form-control" name="input_note" id="input_note" wire:model="input_note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end">
                                    <div class="buttons">
                                        <a class="btn btn-secondary" href="{{ route('backend.transaksi.pengeluaran') }}"
                                            wire:navigate>Batal</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12">
                        <table style="width:100%;">
                            <tbody>
                                <tr>
                                    <td style="width:20%;">Nominal</td>
                                    <td style="width:5%;">Rp. </td>
                                    <td>{{ number_format($input_nominal_non_formatted, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Saldo</td>
                                    <td>Rp. </td>
                                    <td>{{ number_format($selected_wallet['nominal'], 2) }}</td>
                                </tr>
                                <tr style="border-top: 1px solid black; font-weight: bold;">
                                    <td></td>
                                    <td>Rp.</td>
                                    <td>{{ number_format($sum_nominal, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br>

                    <div class="col-12">
                        <h5 style="text-decoration: underline;">Riwayat Transaksi</h5>

                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;">No</th>
                                        <th style="text-align: center; vertical-align: middle;">Transaksi</th>
                                        <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                                        <th style="text-align: center; vertical-align: middle;">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($list_transaksi)
                                        @foreach ($list_transaksi as $key => $transaksi)
                                            <tr>
                                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                                <td>{{ $transaksi['judul'] }}</td>
                                                <td style="text-align: center;">{{ $transaksi['tgl_transaksi'] }}</td>
                                                <td>Rp. {{ number_format($transaksi['nominal'], 2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="float-end">
                            <a href="{{ route('backend.transaksi.pengeluaran', ['curr_wallet' => $input_wallet]) }}">Informasi
                                Selengkapnya ></a>
                        </div>
                    </div>

                </div>

            </div>
        </div>

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
            document.addEventListener('livewire:initialized', () => {
                @this.on('showResult', (response) => popResult2(response));
                @this.on('showResultConfirm', (response) => popResultConfirm(response));
            });

            document.addEventListener('livewire:navigated', () => {
                // console.log('livewire load code when navigated');
                Livewire.on('showResult', (response) => popResult2(response));
                Livewire.on('showResultConfirm', (response) => popResultConfirm(response));
            });
        </script>

        <script>
            // Variable Declare
            var input_date = null;

            // Document ready
            $(function() {

                // Function declare
                function initMasking() {
                    $('.mask-nominal').mask("#,##0", {
                        reverse: true
                    });
                }

                // Initial plugins
                $('#input_wallet').select2({
                    theme: 'bootstrap-5',
                    minimumInputLength: -1,
                    allowClear: true,
                    placeholder: "-- Pilih Wallet --"
                });

                input_date = flatpickr('.input_date', {
                    altInput: true,
                    altFormat: "d F Y",
                    dateFormat: "Y-m-d",
                    // mode: 'range',
                    maxDate: "today",
                    wrap: true,
                    position: "auto center",
                });

                // On Events
                $('#input_wallet').on('change', function(e) {
                    @this.set('input_wallet', e.target.value);
                    @this.call('updateSelectedWallet', e.target.value);
                });

                // Initial function
                initMasking();

                $('#input_wallet').val({{ $current_def_wallet['id'] }}).trigger('change');
                input_date.set('defaultDate', '{{ $input_date }}');

            });

            function popResultConfirm(response) {
                let res = response.result;

                if (res.success) {
                    Swal.fire({
                        title: "{{ __('custom.swal.title.success') }}",
                        text: res.msg,
                        icon: 'success',
                        confirmButtonText: "{{ __('custom.swal.button.ok') }}",
                    }).then((result) => {
                        if (result.isConfirmed) {}

                        Swal.fire({
                            title: "{{ __('custom.swal.title.info') }}",
                            text: res.msg_confirm,
                            icon: 'info',
                            showDenyButton: true,
                            confirmButtonText: "{{ __('custom.swal.button.yes') }}",
                            denyButtonText: "{{ __('custom.swal.button.no') }}",
                        }).then((result2) => {
                            if (result2.isConfirmed) {
                                window.location.reload();
                            } else if (result2.isDenied) {
                                if (res.uri) {
                                    window.location.href = res.uri;
                                }
                            }
                        });
                    });
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
