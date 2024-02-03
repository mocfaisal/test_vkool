@section('app.title', 'LPSE Product')
@section('content.header.title', 'LPSE Product')

<div>
    {{-- Root div must be added --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">List LPSE Shop</h4>
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

        // Function Declare
        async function initTableElem() {
            const field_table = $('#field_table');
            const txt =
                '<table id="tbl_list" class="table-striped table-hover table table" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;" rowspan="2">No.</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Shop Name</th> <th style="vertical-align: middle; text-align: center;" colspan="2">Total Product</th> </tr> <tr> <th style="vertical-align: middle; text-align: center;">Show</th> <th style="vertical-align: middle; text-align: center;">Draft</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData(dataPost = null) {
            var tbl_link = "{{ route('backend.admin.lpse.product.getData.table') }}";

            var ajaxOptions = {
                url: tbl_link,
                type: "POST",
                dataType: "JSON",
            };

            if (dataPost) {
                ajaxOptions = {
                    url: tbl_link,
                    type: "POST",
                    dataType: "JSON",
                    data: dataPost,
                };
            }

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
                        data: 'name_pt',
                    },
                    {
                        data: 'jml_approved',
                        searchable: false
                    },
                    {
                        data: 'jml_unapproved',
                        searchable: false
                    },
                ],
                columnDefs: [{
                        className: 'dt-center',
                        targets: [0, 2, 3]
                    },
                    {
                        render: function(data, type, row) {
                            let url =
                                "{{ route('backend.admin.lpse.product.detail', ['shop_id' => ':id', 'cond' => 1]) }}";
                            url = url.replace(':id', row.id);

                            return '<a href="' + url + '" wire:navigate>' + data + '</a>';
                        },
                        targets: 2
                    },
                    {
                        render: function(data, type, row) {
                            let url =
                                "{{ route('backend.admin.lpse.product.detail', ['shop_id' => ':id', 'cond' => 0]) }}";
                            url = url.replace(':id', row.id);

                            return '<a href="' + url + '" wire:navigate>' + data + '</a>';
                        },
                        targets: 3
                    },
                ],
                order: [
                    [2, 'desc']
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

        // Initial function
        // loadData();
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
