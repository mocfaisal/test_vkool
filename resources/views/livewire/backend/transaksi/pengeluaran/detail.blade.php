<div class="modal fade text-left" id="mdl_detail" data-bs-backdrop="static" tabindex="-1" role="dialog"
aria-labelledby="mdl_detail_label" aria-hidden="true" wire:ignore.self>
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="mdl_detail_label">
                Detail Pemasukan
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
                            <label>Judul</label>
                            <input type="text" class="form-control" placeholder="Sumber Dana"
                                wire:model="judul" readonly>
                            @error('judul')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="text" class="form-control" placeholder="Sumber Dana"
                                wire:model="nominal" readonly>
                            @error('nominal')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label>Sumber Dana</label>
                            <input type="text" class="form-control" placeholder="Sumber Dana"
                                wire:model="sumber_dana" readonly>
                            @error('sumber_dana')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" class="form-control" placeholder="Tanggal"
                                wire:model="tgl_transaksi" readonly>
                            @error('sumber_dana')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" wire:model="catatan" readonly></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </form>

    </div>
</div>
</div>
