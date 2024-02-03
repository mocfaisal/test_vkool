<div class="modal fade text-left" id="mdl_hutang_pop" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="mdl_hutang_pop_label" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mdl_hutang_pop_label">
                    @if ($is_edit)
                        Edit
                    @else
                        Tambah
                    @endif
                    Data Hutang - {{ $title_hutang }}

                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <form>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-12" wire:ignore>
                            <div class="form-group">
                                <label for="input_wallet">Sumber Dana</label>
                                <select class="form-select" id="input_wallet" style="width:100%;"
                                    wire:model="input_wallet" required>
                                    <option value="" disabled>-- Pilih Wallet --</option>
                                    @foreach ($list_wallet as $wallet)
                                        <option value="{{ $wallet['id'] }}" wire:key="{{ $wallet['id'] }}">
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

                        <div class="col-12">
                            <div class="form-group">
                                <label>Nominal</label>
                                <input type="text" class="form-control mask-nominal" placeholder="Nominal"
                                    wire:model="input_nominal">
                                @error('input_nominal')
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
                    <button type="button" class="btn btn-primary"
                        wire:click="$dispatch('popHutang-save')">Simpan</button>
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

            $('#input_wallet').select2({
                theme: 'bootstrap-5',
                minimumInputLength: -1,
                allowClear: true,
                placeholder: "-- Pilih Wallet --"
            });

            // On Events
            $('#input_wallet').on('change', function(e) {
                @this.set('input_wallet', e.target.value);
            });

            initMasking();

        });
    </script>
    <script>
        var mdl_hutang_pop_elem = document.querySelector('#mdl_hutang_pop');
        var mdl_hutang_pop = null;

        document.addEventListener('livewire:initialized', () => {
            mdl_hutang_pop = bootstrap.Modal.getOrCreateInstance(mdl_hutang_pop_elem)

            // Listen to dispatch from server
            @this.on('popHutang_modal', (res) => {
                mdl_hutang_pop.show();
                //alert('product created/updated')
                // var mdl_hutang_pop_elem = document.querySelector('#mdl_hutang_pop')
                // var modal = bootstrap.Modal.getOrCreateInstance(mdl_hutang_pop_elem)

                // setTimeout(() => {
                // @this.dispatch('reset-modal');
                // }, 5000);

                setTimeout(() => {
                    $('#input_wallet').val({{ $input_wallet }});
                    $('#input_wallet').trigger('change');
                }, 500);
            })

            mdl_hutang_pop_elem.addEventListener('shown.bs.modal', (event) => {
                // let is_checked = $('#input_remider').is(':checked');
                // if (is_checked) {
                //     $('#field_remider').prop('hidden', false);
                // } else {
                //     $('#field_remider').prop('hidden', true);
                // }
            })

            mdl_hutang_pop_elem.addEventListener('hidden.bs.modal', (event) => {
                @this.dispatch('reset-modal');
                // $('#field_remider').prop('hidden', true);
            })

        });

        document.addEventListener('livewire:navigated', () => {
            mdl_hutang_pop = bootstrap.Modal.getOrCreateInstance(mdl_hutang_pop_elem)

            Livewire.on('popHutang_modal', (res) => {
                mdl_hutang_pop.show();
                //alert('product created/updated')
                // var mdl_hutang_pop_elem = document.querySelector('#mdl_hutang_pop')
                // var modal = bootstrap.Modal.getOrCreateInstance(mdl_hutang_pop_elem)

                // setTimeout(() => {
                // Livewire.dispatch('reset-modal');
                // }, 5000);

                setTimeout(() => {
                    $('#input_wallet').val({{ $input_wallet }});
                    $('#input_wallet').trigger('change');
                }, 500);
            })

            mdl_hutang_pop_elem.addEventListener('hidden.bs.modal', (event) => {
                Livewire.dispatch('reset-modal');
                // $('#field_remider').prop('hidden', true);
            })

            // console.log('livewire load code when navigated');
            // Listen to dispatch from server
            Livewire.on('showResult', (response) => {
                popResult(table, response);
                mdl_hutang_pop.hide();
            });

            Livewire.on('showResult2', (response) => {
                popResult2(response);
                mdl_hutang_pop.hide();
            });
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
