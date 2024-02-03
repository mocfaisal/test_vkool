@section('app.title', 'LPSE Product')
@section('content.header.title', 'LPSE Product - ' . $shop_name)

<div>
    {{-- Root div must be added --}}
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h4 class="card-title">List Product</h4>
            </div>
            <div class="float-end">
                <div class="buttons">
                    <a class="btn icon icon-left btn-warning" href="{{ route('backend.admin.lpse.management') }}"
                        wire:navigate><i class="bi bi-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="field_table"></div>
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
        var table_review = null;

        // Function Declare
        async function initTableElem() {
            const field_table = $('#field_table');
            const txt =
                '<table id="tbl_list" class="table-striped table-hover table table" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;">No.</th> <th style="vertical-align: middle; text-align: center;">SKU</th> <th style="vertical-align: middle; text-align: center;">Product Name</th> <th style="vertical-align: middle; text-align: center;">Stock</th> <th style="vertical-align: middle; text-align: center;">Last Update</th> <th style="vertical-align: middle; text-align: center;">Action</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData() {
            var tbl_link = "{{ route('backend.admin.lpse.management.detail.getData.table') }}";

            var ajaxOptions = {
                url: tbl_link,
                type: "POST",
                dataType: "JSON",
                data: {
                    shop_id: "{{ $shop_id }}",
                },
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
                        data: 'sku',
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'stock',
                        searchable: false
                    },
                    {
                        data: 'last_update',
                        searchable: false
                    }, {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
                columnDefs: [{
                    className: 'dt-center',
                    targets: [0, 3, 4, 5]
                }, ],
                order: [
                    [2, 'asc']
                ],
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

        // Initial function
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
