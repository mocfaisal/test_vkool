@section('app.title', 'List Data Transaksi Tabungan' . $nm_saving)
@section('content.header.title', 'List Data Transaksi')

<div>
    {{-- Root div must be added --}}

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-1">
                    <a class="btn icon icon-left btn-warning" href="{{ route('backend.transaksi.savings') }}"
                        wire:navigate><i class="bi bi-arrow-left"></i></a>
                </div>
                <div class="col">
                    <h4 class="card-title">Tabungan {{ $nm_saving }}</h4>

                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-3" wire:ignore>
                    <div class="form-group">
                        <label for="search_wallet">Wallet</label>
                        <select class="form-select" id="search_wallet" wire:model="search_wallet" style="width:100%;">
                            <option value="">-- Semua Wallet --</option>
                            @foreach ($list_wallet as $wallet)
                                <option value="{{ $wallet['id'] }}" @if ($wallet['id'] == $search_wallet) selected @endif>
                                    {{ $wallet['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-4" wire:ignore>
                    <div class="form-group">
                        <label for="search_tgl_transaksi">Tanggal Transaksi</label>
                        <div class="input-group flatpickr">
                            <input type="text" class="form-control" id="search_tgl_transaksi" data-input
                                placeholder="Pilih tanggal transaksi" wire:model="search_tgl_transaksi">
                            <div class="btn-group">
                                <button type="button" class="btn input-button" data-toggle title="toggle">
                                    <i class="bi bi-calendar"></i>
                                </button>

                                <button type="button" class="btn input-button" data-clear title="clear">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
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

            <div class="table-responsive" id="field_table"></div>
        </div>
        <div class="card-footer">
            <div class="text-muted">
                {{-- <span>*Status Display is showed on footer of page</span> --}}
            </div>
        </div>

    </div>

    <livewire:backend.transaksi.savings.pop-add>
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
        var table = null;
        var date_range = null;

        // Function Declare
        async function initTableElem() {
            const field_table = $('#field_table');
            const txt =
                '<table id="tbl_list" class="table-striped table-hover table table" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;">No</th> <th style="vertical-align: middle; text-align: center;">Tanggal</th> <th style="vertical-align: middle; text-align: center;">Sumber Dana</th> <th style="vertical-align: middle; text-align: center;">Nominal</th> <th style="vertical-align: middle; text-align: center;">Aksi</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData() {
            var tbl_link = "{{ route('backend.transaksi.savings.detail.getData.table', ['id_saving' => $id_saving]) }}";
            var search_wallet = $('#search_wallet').val();
            var search_tgl_transaksi = $('#search_tgl_transaksi').val();

            var ajaxOptions = {
                url: tbl_link,
                type: "POST",
                dataType: "JSON",
                data: {
                    'wallet': search_wallet,
                    'tgl_transaksi': search_tgl_transaksi,
                }
            };

            table = await $('#tbl_list').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: ajaxOptions,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: "5%",
                    },
                    {
                        data: 'tgl_transaksi',
                        width: "15%",
                    },
                    {
                        data: 'nama_wallet',
                    },

                    {
                        data: 'nominal',
                        render: DataTable.render.number(null, null, 2, 'Rp ')
                    },

                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    className: 'dt-center',
                    targets: [0, 1, 4]
                }],
                order: [
                    [1, 'desc']
                ],
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // converting to interger to find total
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // computing column Total of the complete result

                    var totalNominal = api
                        .column(3)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);


                    // Update footer by showing the total with the reference of the column index
                    $(api.column(0).footer()).html('Total');
                    $(api.column(3).footer()).html(numberToRupiah.format(totalNominal));
                },
            });

            return false;
        }

        async function initTable() {
            if (table instanceof $.fn.dataTable.Api) {
                table.clear().destroy();
            }

            let is_table_ini = await initTableElem();
            if (is_table_ini) {
                // loadData();
            }
        }

        function popDelete(id) {
            Swal.fire({
                title: "{{ __('custom.swal.title.confirm', ['first' => 'untuk menghapus', 'second' => 'data']) }}",
                showDenyButton: true,
                confirmButtonText: "{{ __('custom.swal.button.yes') }}",
                denyButtonText: "{{ __('custom.swal.button.no') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('destroy', id);
                }
            })
        }

        // On Event
        $('#btn_search').on('click', function() {
            loadData();
        });

        // initial function
        initTable();

        date_range = flatpickr('.flatpickr', {
            altInput: true,
            altFormat: "d F Y",
            dateFormat: "Y-m-d",
            mode: 'range',
            maxDate: "today",
            wrap: true,
            position: "auto center",
        });

        $('#search_wallet').select2({
            theme: 'bootstrap-5',
            minimumInputLength: -1,
            allowClear: true,
            // placeholder: "-- Pilih Wallet --"
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            // var mdl_detail_elem = document.querySelector('#mdl_detail')
            // var mdl_detail = bootstrap.Modal.getOrCreateInstance(mdl_detail_elem);

            // Listen to dispatch from server
            @this.on('showResult', (response) => {
                popResult(table, response);
            });

            // @this.on('show_detail', (response) => {
            //     mdl_detail.show();
            //     // console.log(response);
            // });

        });

        document.addEventListener('livewire:navigated', () => {
            // console.log('livewire load code when navigated');
            // Listen to dispatch from server
            Livewire.on('showResult', (response) => popResult(table, response));
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
