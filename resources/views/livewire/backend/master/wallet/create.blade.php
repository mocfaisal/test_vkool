<div class="modal fade text-left" id="mdl_wallet" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="mdl_wallet_label" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mdl_wallet_label">
                    @if ($is_edit)
                        Edit
                    @else
                        Tambah
                    @endif
                    Wallet

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
                                <input type="text" class="form-control" placeholder="Nama" wire:model="input_nama">
                                @error('input_nama')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="checkbox">
                                        <input type="checkbox" class="form-check-input" value="1"
                                            wire:model="input_cb_default">
                                        <label for="mdl_cb_default">Jadikan Sumber Dana Utama?</label>
                                        @error('input_cb_default')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
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
