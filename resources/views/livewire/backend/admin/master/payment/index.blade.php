@section('app.title', 'Payment')
@section('content.header.title', 'Payment')

<div>
    {{-- Root div must be added --}}

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h4 class="card-title">Payment</h4>
            </div>
            <div class="float-end">
                <div class="buttons">
                    <a class="btn icon icon-left btn-primary" href="{{ route('backend.admin.master.payment.create') }}"
                        wire:navigate><i class="bi bi-plus"></i> Add Data</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="field_table"></div>
        </div>
        <div class="card-footer">
            <div class="text-muted">
                <span>*Status Display is showed on footer of page</span>
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
        // Variable Declare
        var table = null;

        // Function Declare
        async function initTableElem() {
            const field_table = $('#field_table');
            const txt = '<table id="tbl_list" class="table-striped table-hover table table" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;" rowspan="2">No.</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Image</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Name</th> <th style="vertical-align: middle; text-align: center;" colspan="2">Fee</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Type</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Code</th> <th style="vertical-align: middle; text-align: center;" colspan="2">Status</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Action</th> </tr> <tr> <th style="vertical-align: middle; text-align: center;">Nominal</th> <th style="vertical-align: middle; text-align: center;">Percent</th> <th style="vertical-align: middle; text-align: center;">Display</th> <th style="vertical-align: middle; text-align: center;">Active</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData() {
            var tbl_link = "{{ route('backend.admin.master.payment.getData.table') }}";

            var ajaxOptions = {
                url: tbl_link,
                type: "POST",
                dataType: "JSON",
            };

            table = await $('#tbl_list').DataTable({
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
                        data: 'image'
                    },
                    {
                        data: 'name'
                    },

                    {
                        data: 'fee_nominal'
                    },
                    {
                        data: 'fee_percent'
                    },
                    {
                        data: 'flag'
                    },
                    {
                        data: 'code'
                    },
                    {
                        data: 'is_show'
                    },
                    {
                        data: 'active'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    className: 'dt-center',
                    targets: [0, 4, 7, 8,9]
                }],
                order: [
                    [2, 'asc']
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

        function popStatus(id, type, stat) {
            Swal.fire({
                title: "{{ __('custom.swal.title.confirm', ['first' => 'update', 'second' => 'status']) }}",
                showDenyButton: true,
                confirmButtonText: "{{ __('custom.swal.button.yes') }}",
                denyButtonText: "{{ __('custom.swal.button.no') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('update_status', id, type, stat);
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
            @this.on('showResult', (response) => popResult(table, response));
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
