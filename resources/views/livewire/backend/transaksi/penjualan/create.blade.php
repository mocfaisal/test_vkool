<div>
    {{-- Success is as dangerous as failure. --}}

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h4 class="card-title">Tambah Data</h4>
            </div>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-md-12 col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama Transaksi</label>
                                <input type="text" class="form-control" placeholder="Nama Transaksi"
                                    wire:model="input_nama_trx">
                                @error('input_nama_trx')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama Customer</label>
                                <input type="text" class="form-control" placeholder="Nama Customer"
                                    wire:model="input_nama_customer">
                                @error('input_nama_customer')
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

            <div class="divider">
                <div class="divider-text">Inventory</div>
            </div>

            <div class="row">

                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label>Nama Inventory</label>
                        <input type="text" class="form-control autocomplete" id="input_nama"
                            placeholder="Nama Inventory" wire:model="input_nama">
                    </div>
                </div>

                <div class="row">
                    <label for="input_ukur_l">Ukuran</label>
                    <div class="col-md-6 col-6">
                        <div class="form-group">
                            <label for="input_ukur_l">Lebar (cm)</label>
                            <input type="number" class="form-control" placeholder="Lebar" wire:model="input_ukur_l"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="form-group">
                            <label for="input_ukur_p">Panjang (cm)</label>
                            <input type="number" class="form-control" placeholder="Panjang" wire:model="input_ukur_p"
                                readonly>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="col-md-6 col-6">
                    <div class="form-group">
                        <label for="input_posisi_kaca">Posisi Kaca</label>
                        <input type="text" class="form-control" placeholder="Posisi Kaca"
                            wire:model="input_posisi_kaca" readonly>
                    </div>
                </div>

                <div class="col-md-6 col-6">
                    <div class="form-group">
                        <label for="input_warna">Warna</label>
                        <input type="text" class="form-control" placeholder="Warna" wire:model="input_warna"
                            readonly>
                    </div>
                </div>

                <div class="col-md-6 col-6">
                    <div class="form-group">
                        <label for="input_service">Service</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Warna" wire:model="input_service"
                                readonly>
                            <button type="button" class="btn btn-primary icon" wire:click="processAddItem"><i
                                    class="bi bi-plus-circle"></i>
                                Add</button>

                        </div>
                    </div>
                </div>

            </div>

        </div>
        <hr>

        <div class="table-responsive">
            <table class="table-striped table-hover table table" id="tbl_list" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="vertical-align: middle; text-align: center;" rowspan="3">No</th>
                        <th style="vertical-align: middle; text-align: center;" rowspan="3">Nama</th>
                        <th style="vertical-align: middle; text-align: center;" colspan="6">Atribut</th>
                        <th style="vertical-align: middle; text-align: center;" rowspan="3">Qty</th>
                        <th style="vertical-align: middle; text-align: center;" rowspan="3">Aksi</th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: center;" rowspan="2">Status</th>
                        <th style="vertical-align: middle; text-align: center;" colspan="2">Ukuran</th>
                        <th style="vertical-align: middle; text-align: center;" rowspan="2">Posisi Kaca</th>
                        <th style="vertical-align: middle; text-align: center;" rowspan="2">Warna</th>
                        <th style="vertical-align: middle; text-align: center;" rowspan="2">Service</th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: center;">Lebar (cm)</th>
                        <th style="vertical-align: middle; text-align: center;">Panjang&nbsp;(cm)</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($this->listDetail))
                        @foreach ($this->listDetail as $item)
                            <tr wire:key="{{ $item->id }}">
                                <td style="vertical-align: middle; text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->is_attribute == 1 ? 'Ada Atribut' : 'Non Atribut' }}</td>
                                <td>{{ $item->ukur_lebar }}</td>
                                <td>{{ $item->ukur_panjang }}</td>
                                <td>{{ $item->nm_posisi_kaca }}</td>
                                <td>{{ $item->nm_warna }}</td>
                                <td>{{ $item->nm_service }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $item->qty }}</td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <a class="btn icon btn-danger" data-bs-title="Delete" href="javascript:void(0);"
                                        onclick="popDelete({{ $item->id }})"><i class="bi bi-x"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <br>
        <div class="row">
            <div class="col-12">
                <div class="form-actions d-flex justify-content-end ms-auto">
                    <button type="button" class="btn btn-primary me-1" wire:click="processSave">Simpan</button>
                    <button type="button" class="btn btn-light-primary" wire:click="processCancel">Batal</button>
                </div>
            </div>
        </div>
        <br>
    </div>

</div>

@push('scripts')
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
@endpush

@section('private.js.code')
    <script>
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

        // $(document).ready(function() {
        $("#input_nama").autocomplete({
            source: function(request, response) {

                $.ajax({
                    url: "{{ route('backend.transaksi.penjualan.getData.Inv') }}",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });

                // NOTE Error
                // var responseData = @this.call('getListInventory', request.term);
                // responseData.then((data) => {
                //     var data = JSON.parse(data);
                //     response(data);
                //     console.log(data);
                // });

            },
            select: function(event, ui) {

                @this.set('input_id_inventory', ui.item.id);
                @this.set('is_attribute', ui.item.is_attribute);
                @this.set('id_posisi_kaca', ui.item.id_posisi_kaca);
                @this.set('id_warna', ui.item.id_warna);
                @this.set('id_service', ui.item.id_service);
                @this.set('input_nama', ui.item.nama);
                @this.set('input_posisi_kaca', ui.item.nm_posisi_kaca);
                @this.set('input_warna', ui.item.nm_warna);
                @this.set('input_service', ui.item.nm_service);
                @this.set('input_ukur_l', ui.item.ukur_lebar);
                @this.set('input_ukur_p', ui.item.ukur_panjang);

                return false;
            }
        });
        // });
    </script>
@endsection
