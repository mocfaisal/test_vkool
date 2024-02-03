@section('app.title', 'Product Category')
@section('content.header.title', 'Product Category')

@php
    $routeData_back = [];

    if ($category_level != 1) {
        $routeData_back = ['level' => $category_level_before];
        if ($category_level > 2) {
            $routeData_back['parent_id'] = $category_parent_id_before;
        }
    }

@endphp

<div>
    {{-- Root div must be added --}}

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h4 class="card-title"> Category Level : {{ $category_level }} </h4>

                @if ($category_name)
                    <h4 class="card-title"> Category Name : {{ $category_name }} </h4>
                @endif

            </div>
            <div class="float-end">
                <div class="buttons">
                    @if ($category_level != 1)
                        <a class="btn icon icon-left btn-warning"
                            href="{{ route('backend.admin.master.product.category', $routeData_back) }}" wire:navigate><i
                                class="bi bi-arrow-left"></i> Back</a>
                    @endif

                    <a class="btn icon icon-left btn-primary"
                        href="{{ route('backend.admin.master.product.category.create', ['parent_id' => $category_parent_id, 'level' => $category_level]) }}"
                        wire:navigate><i class="bi bi-plus"></i> Add Data</a>
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

        // Function Declare
        async function initTableElem() {
            const field_table = $('#field_table');
            const txt =
                '<table class="table-striped table-hover table table" id="tbl_list" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;" rowspan="2">No.</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Icon</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Name</th> <th style="vertical-align: middle; text-align: center;" colspan="2">Status</th> <th style="vertical-align: middle; text-align: center;" rowspan="2">Action</th> </tr> <tr> <th style="vertical-align: middle; text-align: center;">Display</th> <th style="vertical-align: middle; text-align: center;">Active</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData() {
            var tbl_link = "{{ route('backend.admin.product.category.getData.table') }}";

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
                        data: 'icon',
                    }, {
                        data: 'name',
                    },
                    {
                        data: 'display_status',
                    }, {
                        data: 'active',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    className: 'dt-center',
                    targets: [0, 1, 3, 4, 5]
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
        // document.addEventListener('livewire:init', () => {
        //     // Runs after Livewire is loaded but before it's initialized
        //     // on the page...
        //     console.log('livewire before init');
        // });

        // document.addEventListener('livewire:initialized', () => {
        //     // Runs immediately after Livewire has finished initializing
        //     // on the page...
        //     // console.log('livewire after init');
        //     console.log('livewire load code when init');
        //     // loadData();

        // });

        // document.addEventListener('livewire:navigating', () => {
        //     // Mutate the HTML before the page is navigated away...
        //     console.log('Mutate the HTML before the page is navigated away');
        // });

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
