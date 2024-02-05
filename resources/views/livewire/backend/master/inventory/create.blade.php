<div>

    <div class="modal fade text-left" id="mdl_inventory" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="mdl_inventory_label" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdl_inventory_label">
                        @if ($is_edit)
                            Edit
                        @else
                            Tambah
                        @endif
                        Data
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <form>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama"
                                        wire:model="input_nama">
                                    @error('input_nama')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12" wire:ignore>
                                <div class="form-group d-flex justify-content-between">
                                    <label for="is_attribute">Atribut</label>
                                    <div class="form-check form-check-lg form-switch">
                                        <input type="checkbox" class="form-check-input" id="is_attribute"
                                            style="width:3.5rem;" wire:model.debounce="is_attribute">
                                    </div>
                                    @error('is_attribute')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <div id="field_attribute" {{ !$is_attribute ? 'hidden' : '' }}>

                                <div class="row">
                                    <label for="input_ukur_l">Ukuran</label>
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="input_ukur_l">Lebar (cm)</label>
                                            <input type="number" class="form-control" placeholder="Lebar"
                                                wire:model="input_ukur_l">
                                            @error('input_ukur_l')
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="input_ukur_p">Panjang (cm)</label>
                                            <input type="number" class="form-control" placeholder="Panjang"
                                                wire:model="input_ukur_p">
                                            @error('input_ukur_p')
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-12 col-12" wire:ignore>
                                    <div class="form-group">
                                        <label for="input_posisi_kaca">Posisi Kaca</label>
                                        <select class="form-select" id="input_posisi_kaca" style="width:100%;"
                                            wire:model="input_posisi_kaca" required>
                                            <option></option>
                                            @foreach ($list_posisi_kaca as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['nama'] }}</option>
                                            @endforeach
                                        </select>

                                        @error('input_posisi_kaca')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12" wire:ignore>
                                    <div class="form-group">
                                        <label for="input_warna">Warna</label>
                                        <select class="form-select" id="input_warna" style="width:100%;"
                                            wire:model="input_warna" required>
                                            <option></option>
                                            @foreach ($list_warna as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['nama'] }}</option>
                                            @endforeach
                                        </select>

                                        @error('input_warna')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12" wire:ignore>
                                    <div class="form-group">
                                        <label for="input_service">Service</label>
                                        <select class="form-select" id="input_service" style="width:100%;"
                                            wire:model="input_service" required>
                                            <option></option>
                                            @foreach ($list_service as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['nama'] }}</option>
                                            @endforeach
                                        </select>

                                        @error('input_service')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" wire:click="save">Simpan</button>
                        </div>
                </form>

            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        // Variable Declare
        var modal_elem = '#mdl_inventory';

        document.addEventListener('livewire:initialized', () => {
            var myModalEl = document.querySelector(modal_elem)
            var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)

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
        // Document ready
        $(function() {

            // Variable Declare

            // Function declare
            function initMasking() {
                $('.mask-nominal').mask("#,##0", {
                    reverse: true
                });
            }

            // var is_checked_attribute = {{ $is_attribute ? 'true' : 'false' }};


            $('#is_attribute').on('change', function() {
                let is_checked = $(this).is(':checked');

                // if (is_checked) {
                //     $('#field_attribute').prop('hidden', false);
                // } else {
                //     $('#field_attribute').prop('hidden', true);
                // }

                @this.set('is_attribute', is_checked);
            });

            // $('#is_attribute').prop('checked', is_checked_attribute).trigger('change');

            // Initial plugins
            $('#input_posisi_kaca').select2({
                theme: 'bootstrap-5',
                minimumInputLength: -1,
                placeholder: "-- Pilih Posisi Kaca --",
                dropdownParent: $(modal_elem)
            });

            $('#input_warna').select2({
                theme: 'bootstrap-5',
                minimumInputLength: -1,
                placeholder: "-- Pilih Warna --",
                dropdownParent: $(modal_elem)
            });

            $('#input_service').select2({
                theme: 'bootstrap-5',
                minimumInputLength: -1,
                placeholder: "-- Pilih Service --",
                dropdownParent: $(modal_elem)
            });

            // On Events
            $('#input_posisi_kaca').on('change', function(e) {
                @this.set('input_posisi_kaca', e.target.value);
            });

            $('#input_warna').on('change', function(e) {
                @this.set('input_warna', e.target.value);
            });

            $('#input_service').on('change', function(e) {
                @this.set('input_service', e.target.value);
            });

            // Initial function
            // initMasking();

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
@endpush
