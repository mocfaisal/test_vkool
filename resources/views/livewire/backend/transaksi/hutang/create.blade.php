<div class="modal fade text-left" id="mdl_hutang" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="mdl_hutang_label" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mdl_hutang_label">
                    @if ($is_edit)
                        Edit
                    @else
                        Tambah
                    @endif
                    Data Hutang

                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <form>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Hutang</label>
                                <input type="text" class="form-control" placeholder="Nama Hutang"
                                    wire:model="input_nama">
                                @error('input_nama')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Nominal Hutang</label>
                                <input type="text" class="form-control mask-nominal" placeholder="Nominal Hutang"
                                    wire:model="input_nominal_target" wire:change="calc_simulasi">
                                @error('input_nominal_target')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Jangka Waktu</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Jangka Waktu" min="1"
                                        max="99" wire:model="input_jangka_waktu" value="1"
                                        wire:change="calc_simulasi">
                                    <span class="input-group-text">Bulan</span>
                                    @error('input_jangka_waktu')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Nominal Simulasi</label>
                                <input type="text" class="form-control mask-nominal" placeholder="Nominal Simulasi"
                                    wire:model="input_nominal_simulasi">
                                @error('input_nominal_simulasi')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="col-12" wire:ignore>
                            <div class="form-group d-flex justify-content-between">
                                <label for="input_remider">Buat Pengingat</label>
                                <div class="form-check form-check-lg form-switch">
                                    <input type="checkbox" class="form-check-input" id="input_remider"
                                        style="width:3.5rem;" wire:model.debounce="input_remider">
                                </div>
                                @error('input_remider')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12" id="field_remider" wire:ignore {{ $is_remider_field ? 'hidden' : '' }}>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <div class="input-group">
                                    <span class="input-group-text">Pengingat Tiap Tanggal</span>
                                    <input type="number" class="form-control" placeholder="Pengingat Tiap Tanggal"
                                        min="1" max="31" wire:model="input_remider_tanggal" value="1">
                                    @error('input_remider_tanggal')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="text-muted">
                                    <span>*Jika tanggal pada bulan tersebut tidak ada, maka akan mengirim pengingat pada
                                        akhir bulan</span>
                                </div>
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

@push('scripts')
    <script>
        $(function(e) {
            function initMasking() {
                $('.mask-nominal').mask("#,##0", {
                    reverse: true
                });
            }

            var is_checked_remider = {{ $input_remider ? 'true' : 'false' }};

            $('#input_remider').on('change', function() {
                let is_checked = $(this).is(':checked');

                if (is_checked) {
                    $('#field_remider').prop('hidden', false);
                } else {
                    $('#field_remider').prop('hidden', true);
                }
                // console.log(is_checked);
                @this.set('input_remider', is_checked);
            });


            initMasking();

            // if (is_checked_remider) {
            //     $('#input_remider').prop('checked', true);
            // } else {
            //     $('#input_remider').prop('checked', false);
            // }

            // $('#input_remider').trigger('change')
        });
    </script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            // var mymodal = document.getElementById('mdl_hutang');
            var myModalEl = document.querySelector('#mdl_hutang')
            var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)

            // Listen to dispatch from server
            @this.on('refresh-data', (event) => {
                //alert('product created/updated')
                // var myModalEl = document.querySelector('#mdl_hutang')
                // var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)

                // setTimeout(() => {
                modal.hide();
                // @this.dispatch('reset-modal');
                // }, 5000);
            })

            myModalEl.addEventListener('shown.bs.modal', (event) => {
                let is_checked = $('#input_remider').is(':checked');
                if (is_checked) {
                    $('#field_remider').prop('hidden', false);
                } else {
                    $('#field_remider').prop('hidden', true);
                }
            })

            myModalEl.addEventListener('hidden.bs.modal', (event) => {
                @this.dispatch('reset-modal');
                $('#field_remider').prop('hidden', true);
            })

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
@endpush
