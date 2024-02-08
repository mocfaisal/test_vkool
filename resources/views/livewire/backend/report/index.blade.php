@section('app.title', 'Report')
@section('content.header.title', 'Report')

<div>
    {{-- Root div must be added --}}

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h4 class="card-title">List Data</h4>
            </div>
        </div>
        <div class="card-body">

            <div class="col-12">

                <div class="input-group">
                    <span class="input-group-text">Date Range</span>
                    <input type="date" class="form-control" id="date_start" title="Start Date" wire:model="date_start"
                        max="{{ date('Y-m-d') }}">
                    <input type="date" class="form-control" id="date_end" title="End Date" wire:model="date_end"
                        max="{{ date('Y-m-d') }}">
                    <button class="btn btn-primary" wire:click="searchData">Search</button>
                </div>
            </div>
            <br>

            @if (!empty($this->dataCart))

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Transaction</th>
                                <th style="text-align: center; vertical-align: middle;">User</th>
                                <th style="text-align: center; vertical-align: middle;">Status</th>
                                <th style="text-align: center; vertical-align: middle;">Date</th>
                                <th style="text-align: center; vertical-align: middle;">Total</th>
                                <th style="text-align: center; vertical-align: middle;">Item</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->dataCart as $item)
                                <tr wire:key="{{ $item->id }}">
                                    <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}
                                    </td>

                                    <td style="vertical-align: middle;">
                                        {{ $item->nama_transaksi }}
                                    </td>
                                    <td style="vertical-align: middle;">
                                        {{ $item->nama_customer }}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        {{ $item->status }}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        {{ Carbon\Carbon::parse($item->tgl_transaksi)->format('d F Y') }}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        {{ number_format($item->total_item) }}
                                    </td>
                                    <td style="vertical-align: top;">
                                        @foreach ($item->detail as $detail_item)
                                            {{ $detail_item->nama }} x {{ $detail_item->qty }} <br>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <button class="btn btn-primary" wire:click="printReport">Print</button>
            @endif
        </div>

    </div>
    <div class="card-footer">
        <div class="text-muted">
            {{-- <span>*Status Display is showed on footer of page</span> --}}
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

@push('scripts')
    <script>
        document.getElementById('date_start').onchange = function() {
            var inputElement_start = document.getElementById('date_start');
            var inputElement_end = document.getElementById('date_end');
            var value_start = inputElement_start.value;
            var value_end = inputElement_end.value;

            // @this.set('date_start', this.value);
            if (value_end) {
                if (value_start > value_end) {
                    inputElement_start.value = value_end;
                }
            }

        }

        document.getElementById('date_end').onchange = function() {
            var inputElement_start = document.getElementById('date_start');
            var inputElement_end = document.getElementById('date_end');
            var value_start = inputElement_start.value;
            var value_end = inputElement_end.value;

            // @this.set('date_start', this.value);
            if (value_end) {
                if (value_start > value_end) {
                    inputElement_start.value = value_end;
                }
            }

        }

        document.addEventListener('livewire:initialized', () => {
            @this.on('showResult', (response) => popResult2(response));
        });

        document.addEventListener('livewire:navigated', () => {
            Livewire.on('showResult', (response) => popResult2(response));
        });
    </script>
@endpush

@section('private.js.code')

    <script>
        // Variable Declare
        var table = null;

        // Function Declare
        async function initTableElem() {
            const field_table = $('#field_table');
            const txt =
                '<table id="tbl_list" class="table-striped table-hover table table" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;" rowspan="3">No</th> <th style="vertical-align: middle; text-align: center;" rowspan="3">Nama</th> <th style="vertical-align: middle; text-align: center;" colspan="6">Atribut</th> <th style="vertical-align: middle; text-align: center;" rowspan="3">Aksi</th> </tr> <tr> <th style="vertical-align: middle; text-align: center;" rowspan="2">Status</th> <th style="vertical-align: middle; text-align: center;" colspan="2">Ukuran</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Posisi Kaca</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Warna</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Service</th> </tr> <tr> <th style="vertical-align: middle; text-align: center;">Lebar (cm)</th> <th style="vertical-align: middle; text-align: center;">Panjang&nbsp;(cm)</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData() {
            var tbl_link = "{{ route('backend.master.inventory.getData.table') }}";

            var ajaxOptions = {
                url: tbl_link,
                type: "POST",
                dataType: "JSON",
            };

            table = await $('#tbl_list').DataTable({
                "drawCallback": function(settings) {
                    // NOTE init bootstrap tooltip after load data
                    initTooltipsBS();
                },
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: ajaxOptions,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                    },
                    {
                        data: 'is_attribute',
                    },
                    {
                        data: 'ukur_lebar',
                    },
                    {
                        data: 'ukur_panjang',
                    },
                    {
                        data: 'nm_posisi_kaca',
                    },
                    {
                        data: 'nm_warna',
                    },
                    {
                        data: 'nm_service',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    className: 'dt-center',
                    targets: [0, 2, 8]
                }],
                order: [
                    [1, 'asc']
                ]
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

        function popStatus(id, stat) {
            Swal.fire({
                title: "{{ __('custom.swal.title.confirm', ['first' => 'update', 'second' => 'status']) }}",
                showDenyButton: true,
                confirmButtonText: "{{ __('custom.swal.button.yes') }}",
                denyButtonText: "{{ __('custom.swal.button.no') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('update_status', id, stat);
                }
            })
        }

        // On Event

        // initial function
        initTable();
    </script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            var myModalEl = document.querySelector('#mdl_inventory')
            var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)

            // Listen to dispatch from server
            @this.on('showResult', (response) => {
                popResult(table, response);
                modal.hide();
            });

            @this.on('refresh-data', (event) => {
                // setTimeout(() => {
                modal.hide();
                // @this.dispatch('reset-modal');
                // }, 5000);
            })

            @this.on('edit-mode', (res) => {
                // modal.show();

                setTimeout(() => {
                    $('#input_posisi_kaca').trigger('change');
                    $('#input_warna').trigger('change');
                    $('#input_service').trigger('change');
                }, 500);
            })

            myModalEl.addEventListener('shown.bs.modal', (event) => {
                let is_checked = $('#is_attribute').is(':checked');
                if (is_checked) {
                    $('#field_attribute').prop('hidden', false);
                } else {
                    $('#field_attribute').prop('hidden', true);
                }
            });

            myModalEl.addEventListener('hidden.bs.modal', (event) => {
                @this.dispatch('reset-modal');
                $('#field_attribute').prop('hidden', true);
            });

        });

        document.addEventListener('livewire:navigated', () => {
            // console.log('livewire load code when navigated');
            // Listen to dispatch from server

            var myModalEl = document.querySelector('#mdl_inventory')
            var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)

            Livewire.on('showResult', (response) => popResult(table, response));

            Livewire.on('edit-mode', (res) => {
                // modal.show();

                setTimeout(() => {
                    $('#input_posisi_kaca').trigger('change');
                    $('#input_warna').trigger('change');
                    $('#input_service').trigger('change');
                }, 500);
            })

            myModalEl.addEventListener('hidden.bs.modal', (event) => {
                @this.dispatch('reset-modal');
                $('#field_attribute').prop('hidden', true);
            });
        });

        document.addEventListener('livewire:navigating', () => {
            // Mutate the HTML before the page is navigated away...
        });
    </script>
@endsection
