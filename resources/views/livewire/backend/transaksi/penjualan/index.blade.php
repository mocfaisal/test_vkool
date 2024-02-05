@section('app.title', 'Penjualan')
@section('content.header.title', 'Penjualan')

<div>
    {{-- Root div must be added --}}

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h4 class="card-title">List Data</h4>
            </div>
            <div class="float-end">
                <div class="buttons">
                    <a class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#mdl_inventory"><i
                            class="bi bi-plus"></i> Add Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="field_table"></div>
        </div>
        <div class="card-footer">
            <div class="text-muted">
                {{-- <span>*Status Display is showed on footer of page</span> --}}
            </div>
        </div>

    </div>

    <livewire:backend.transaksi.penjualan.create>

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

        // Function Declare
        async function initTableElem() {
            const field_table = $('#field_table');
            const txt = '<table id="tbl_list" class="table-striped table-hover table table" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;" rowspan="3">No</th> <th style="vertical-align: middle; text-align: center;" rowspan="3">Nama</th> <th style="vertical-align: middle; text-align: center;" colspan="6">Atribut</th> <th style="vertical-align: middle; text-align: center;" rowspan="3">Aksi</th> </tr> <tr> <th style="vertical-align: middle; text-align: center;" rowspan="2">Status</th> <th style="vertical-align: middle; text-align: center;" colspan="2">Ukuran</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Posisi Kaca</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Warna</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Service</th> </tr> <tr> <th style="vertical-align: middle; text-align: center;">Lebar (cm)</th> <th style="vertical-align: middle; text-align: center;">Panjang&nbsp;(cm)</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData() {
            var tbl_link = "{{ route('backend.transaksi.penjualan.getData.table') }}";

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
                loadData();
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
