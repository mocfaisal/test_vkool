<div class="modal fade text-left" id="mdl_hutang_pop_detail" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="mdl_hutang_pop_detail_label" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mdl_hutang_pop_detail_label">
                    Detail Hutang - {{ $title_hutang }}
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
                                <label>Target</label>
                                <input type="text" class="form-control mask-nominal" placeholder="Nominal Target"
                                    wire:model="nominal_target" readonly>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Nominal Tercapai</label>
                                <input type="text" class="form-control mask-nominal" placeholder="Nominal Tercapai"
                                    wire:model="nominal_total" readonly>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Jangka Waktu</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Jangka Waktu" min="1"
                                        max="10" wire:model="jangka_waktu" value="1" readonly>
                                    <span class="input-group-text">Tahun</span>
                                </div>
                            </div>
                        </div>

                        @if ($is_remider == 1)
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tanggal Pengingat</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Setiap Tanggal</span>
                                        <input type="number" class="form-control" placeholder="Tanggal Pengingat"
                                            min="1" max="31" wire:model="tgl_remider" readonly>
                                    </div>
                                    <div class="text-muted">
                                        <span>*Jika tanggal pada bulan tersebut tidak ada, maka akan mengirim pengingat
                                            pada
                                            akhir bulan</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-12 row d-flex justify-content-between">
                            <div class="col-4">
                                <span>Detail Hutang</span>
                            </div>

                            <div class="col-3">
                                <a title="Lihat Detail Hutang"
                                    href="{{ route('backend.transaksi.hutang.detail', ['id_hutang' => $id]) }}"
                                    wire:navigate>Lihat >>></a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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

            initMasking();

            // if (is_checked_remider) {
            //     $('#input_remider').prop('checked', true);
            // } else {
            //     $('#input_remider').prop('checked', false);
            // }

            // $('#input_remider').trigger('change');

        });
    </script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            var myModalEl = document.querySelector('#mdl_hutang_pop_detail')
            var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)

            // Listen to dispatch from server
            @this.on('popHutang_detail_modal', (res) => {
                modal.show();
                // console.log(res);

                //alert('product created/updated')
                // var myModalEl = document.querySelector('#mdl_hutang_pop_detail')
                // var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)

                // setTimeout(() => {
                // @this.dispatch('reset-modal');
                // }, 5000);
            })

            myModalEl.addEventListener('shown.bs.modal', (event) => {
                // let is_checked = $('#input_remider').is(':checked');
                // if (is_checked) {
                //     $('#field_remider').prop('hidden', false);
                // } else {
                //     $('#field_remider').prop('hidden', true);
                // }
            })

            myModalEl.addEventListener('hidden.bs.modal', (event) => {
                @this.dispatch('reset-modal');
                // $('#field_remider').prop('hidden', true);
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
