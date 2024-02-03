@section('app.title', 'Wallet')
@section('content.header.title', 'Wallet')

<div>
    {{-- Root div must be added --}}

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h4 class="card-title">Wallet</h4>
            </div>
            <div class="float-end">
                <div class="buttons">
                    <a class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#mdl_wallet"><i
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

    <livewire:backend.master.wallet.create>

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
            const txt = '<table id="tbl_list" class="table-striped table-hover table table" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;">No</th> <th style="vertical-align: middle; text-align: center;">Nama</th> <th style="vertical-align: middle; text-align: center;">Default</th> <th style="vertical-align: middle; text-align: center;">Nominal</th> <th style="vertical-align: middle; text-align: center;">Aksi</th> </tr> </thead> <tfoot> <tr> <th colspan="3">Total</th> <th colspan="1">&nbsp;</th> <th colspan="1">&nbsp;</th> </tr> </tfoot> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData() {
            var tbl_link = "{{ route('backend.master.wallet.getData.table') }}";

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
                        data: 'is_default',
                    },
                    {
                        data: 'nominal',
                        render: DataTable.render.number( null, null, 2, 'Rp ' )
                    },

                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    className: 'dt-center',
                    targets: [0, 2, 4]
                }],
                order: [
                    [1, 'asc']
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
            // Listen to dispatch from server
            @this.on('showResult', (response) => {
                popResult(table, response);
                var myModalEl = document.querySelector('#mdl_wallet')
                var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)
                modal.hide();
            });

            @this.on('refresh-data', (event) => {
                //alert('product created/updated')
                var myModalEl = document.querySelector('#mdl_wallet')
                var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)

                // setTimeout(() => {
                modal.hide();
                // @this.dispatch('reset-modal');
                // }, 5000);
            })

            var mymodal = document.getElementById('mdl_wallet')
            mymodal.addEventListener('hidden.bs.modal', (event) => {
                @this.dispatch('reset-modal');
            })

        });

        document.addEventListener('livewire:navigated', () => {
            // console.log('livewire load code when navigated');
            // Listen to dispatch from server
            Livewire.on('showResult', (response) => popResult(table, response));
        });

        document.addEventListener('livewire:navigating', () => {
            // Mutate the HTML before the page is navigated away...
        });
    </script>
@endsection
