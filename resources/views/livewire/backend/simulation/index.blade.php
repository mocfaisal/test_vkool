@section('app.title', 'Simulasi')
@section('content.header.title', 'Simulasi')

@php
    $disk = 'public';
    $file_name = '/simulasi.png';
    $file_path = 'simulasi' . $file_name;
    $images = '';

    if (Storage::disk($disk)->exists($file_path)) {
        $url = Storage::disk($disk)->url($file_path);
        $images = asset($url);
    }
@endphp

<div>
    {{-- Root div must be added --}}

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h4 class="card-title">Simulasi</h4>
            </div>
        </div>
        <div class="card-body">
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
                        <input type="text" class="form-control" placeholder="Warna" wire:model="input_service"
                            readonly>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <img class="img-fluid" src="{{ $images }}" alt="Image"
                            style="width: 100%; height: 100%;">
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
        </script>

    @endsection
