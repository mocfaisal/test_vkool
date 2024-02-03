@section('app.title', 'LPSE Product')
@section('content.header.title', 'LPSE Product - ' . $shop_name)

<div>
    {{-- Root div must be added --}}
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h4 class="card-title">List Product - {{ $shop_cond_text }}</h4>
            </div>
            <div class="float-end">
                <div class="buttons">
                    <a class="btn icon icon-left btn-warning" href="{{ route('backend.admin.lpse.product') }}"
                        wire:navigate><i class="bi bi-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="field_table"></div>
        </div>
    </div>

</div>

@section('modal')
    <div class="modal fade text-left" id="mdl_product_review" tabindex="-1" role="dialog"
        aria-labelledby="mdl_product_review_label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Review Product </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <form>
                    <div class="modal-body">
                        <div class="table-responsive" id="field_table_review"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

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

        async function initTableReviewElem() {
            const field_table = $('#field_table_review');
            const txt =
                '<table id="tbl_list_review" class="table-striped table-hover table table" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;">No.</th> <th style="vertical-align: middle; text-align: center;">Rating</th> <th style="vertical-align: middle; text-align: center;">User</th> <th style="vertical-align: middle; text-align: center;">Review</th> <th style="vertical-align: middle; text-align: center;">Date</th> <th style="vertical-align: middle; text-align: center;">Action</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData() {
            var tbl_link = "{{ route('backend.admin.lpse.product.detail.getData.table') }}";

            var ajaxOptions = {
                url: tbl_link,
                type: "POST",
                dataType: "JSON",
                data: {
                    shop_id: "{{ $shop_id }}",
                    shop_cond: "{{ $shop_cond }}"
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

        async function loadDataReview(product_id) {
            var tbl_link = "{{ route('backend.admin.lpse.product.detail.review.getData.table') }}";

            var ajaxOptions = {
                url: tbl_link,
                type: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id
                },
            };

            table = await $('#tbl_list_review').DataTable({
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
                        data: 'rating',
                    },
                    {
                        data: 'nama',
                    },
                    {
                        data: 'message',
                        searchable: false
                    },
                    {
                        data: 'created_dt',
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

        async function initTableReview() {
            if (table_review instanceof $.fn.dataTable.Api) {
                table_review.clear().destroy();
            }

            let is_table_review_ini = await initTableReviewElem();
            if (is_table_review_ini) {
                // loadDataReview();
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

        function popStatus2(id, stat) {
            Swal.fire({
                title: "{{ __('custom.swal.title.confirm', ['first' => 'update', 'second' => 'status']) }}",
                showDenyButton: true,
                confirmButtonText: "{{ __('custom.swal.button.yes') }}",
                denyButtonText: "{{ __('custom.swal.button.no') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('update_status_review', id, stat);
                }
            })
        }

        async function popProductReview(product_id) {
            var mdl = $('#mdl_product_review');
            var NewData = new FormData();
            var form = mdl.find('form');

            // var mdl_product_review_label = form.find('[name="mdl_product_review_label"]');
            var mdl_product_review_label = form.parent("div").find('.modal-title');

            let data = await loadDataReview(product_id).then(function(response) {
                mdl_product_review_label.text('Review Product');
                mdl.modal('show');
            });

        }

        // On Event
        $('#mdl_product_review').on("hidden.bs.modal", function(e) {
            var mdl = $(this);
            var form = mdl.find('form');

            var input_name = form.find('[name="mdl_input_name"]');

            input_name.val('');

        });

        // Initial function
        initTable();
        initTableReview();
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
