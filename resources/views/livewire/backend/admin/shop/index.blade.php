@section('app.title', 'Shop')
@section('content.header.title', 'Shop')

<div>
    {{-- Root div must be added --}}

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Search</h4>
        </div>
        <div class="card-body">

            <div class="row justify-content-center">

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label" for="input_name">Name</label>
                        <input type="text" class="form-control" name="input_name" id="input_name">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label" for="input_company_name">Company Name</label>
                        <input type="text" class="form-control" name="input_company_name" id="input_company_name">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label" for="input_type">Type</label>
                        <select class="form-control form-select" name="input_type" id="input_type">
                            <option value="">All</option>
                            <option value="silver">Silver</option>
                            {{-- <option value="gold">Gold</option> --}}
                            {{-- <option value="platinum">Platinum</option> --}}
                            <option value="trusted_seller">Trusted Seller</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label" for="input_status">Status</label>
                        <select class="form-control form-select" name="input_status" id="input_status">
                            <option value="">All</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="mt-4">
                        <button type="button" class="btn icon btn-primary" id="btn_search" onclick="findData(this)">
                            <i class="bi bi-search"></i>
                            Search
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="field_table"></div>
        </div>
    </div>

</div>

@section('modal')
    <div class="modal fade text-left" id="mdl_shop_detail" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="mdl_shop_detail_label" aria-hidden="true">
        <div class="modal-dialog modal-full modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdl_shop_detail_label">
                        Detail Seller
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <form>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_name">Name</label>
                                    <input type="text" class="form-control" name="mdl_input_name" placeholder="Name"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_company_nama">Company Name</label>
                                    <input type="text" class="form-control" name="mdl_input_company_nama"
                                        placeholder="Company Name" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_email">Email</label>
                                    <input type="email" class="form-control" name="mdl_input_email" placeholder="Email"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_no_hp">No. Handphone</label>
                                    <input type="text" class="form-control" name="mdl_input_no_hp"
                                        placeholder="No. Handphone" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_no_npwp">NPWP</label>
                                    <input type="text" class="form-control" name="mdl_input_no_npwp"
                                        placeholder="NPWP Instansi" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_no_nik">NIK</label>
                                    <input type="text" class="form-control" name="mdl_input_no_nik" placeholder="NIK"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_pwd">Password</label>
                                    <input type="text" class="form-control" name="mdl_input_pwd"
                                        placeholder="Password" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="mdl_shop_type" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="mdl_shop_type_label" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdl_shop_type_label">
                        Change Seller Type
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <form>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="input_type">Type</label>
                                    <select class="form-control form-select" name="mdl_input_type">
                                        <option value="silver">Silver</option>
                                        <option value="trusted_seller">Trusted Seller</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" name="btn_save">Save</button>
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

        // Function Declare
        async function initTableElem() {
            const field_table = $('#field_table');
            const txt =
                '<table id="tbl_list" class="table-striped table-hover table table" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;">No.</th> <th style="vertical-align: middle; text-align: center;">Name</th> <th style="vertical-align: middle; text-align: center;">Company Name</th> <th style="vertical-align: middle; text-align: center;">Type</th> <th style="vertical-align: middle; text-align: center;">Status</th> <th style="vertical-align: middle; text-align: center;">Action</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData(dataPost = null) {
            var tbl_link = "{{ route('backend.admin.shop.getData.table') }}";

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
                        data: 'name',
                    }, {
                        data: 'name_pt',
                    },
                    {
                        data: 'type',
                    },
                    {
                        data: 'status',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    className: 'dt-center',
                    targets: [0, 3, 4, 5]
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

        function findData(elem) {

            $(elem).setButton('loading');

            var newData = [];

            var input_name = $('#input_name').val();
            var input_company_name = $('#input_company_name').val();
            var input_type = $('#input_type').val();
            var input_status = $('#input_status').val();

            newData["find"] = {
                "name": input_name,
                "name_pt": input_company_name,
                "type": input_type,
                "status": input_status,
            };

            loadData(newData);

            $(elem).setButton('reset');
        }

        async function get_detail_shop(elem, shop_id) {

            $(elem).setButton('loading', false);

            await @this.call('getData_shop_detail', shop_id).then(result => {
                $(elem).setButton('reset');
            });

        }

        async function get_type_shop(elem, shop_id, curr_type) {

            $(elem).setButton('loading', false);
            var mdl = $('#mdl_shop_type');
            var form = mdl.find('form');

            var input_type = form.find('[name="mdl_input_type"]');
            var btn_save = form.find('[name="btn_save"]');

            input_type.val(curr_type).trigger('change');

            mdl.modal('show');

            $(elem).setButton('reset');

            btn_save.on('click', async function(e) {
                e.preventDefault();
                var new_type = input_type.val();

                await @this.call('update_type', shop_id, new_type).then(result => {
                    $(elem).setButton('reset');
                    mdl.modal('hide');
                });
            });

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

        function popShopDetail(response) {
            let res = response.result;

            var mdl = $('#mdl_shop_detail');
            var NewData = new FormData();
            var form = mdl.find('form');

            var input_name = form.find('[name="mdl_input_name"]');
            var input_company_nama = form.find('[name="mdl_input_company_nama"]');
            var input_email = form.find('[name="mdl_input_email"]');
            var input_pwd = form.find('[name="mdl_input_pwd"]');
            var input_no_hp = form.find('[name="mdl_input_no_hp"]');
            var input_no_npwp = form.find('[name="mdl_input_no_npwp"]');
            var input_no_nik = form.find('[name="mdl_input_no_nik"]');

            if (res.success) {
                let data = res.data;

                input_name.val(data.name);
                input_company_nama.val(data.nama_pt);
                // input_email.val(data.email);
                input_pwd.val(data.pass_txt);
                input_no_hp.val(data.phone);
                input_no_npwp.val(data.npwp);
                input_no_nik.val(data.nik_pemilik);

                mdl.modal('show');

            } else {
                Swal.fire({
                    title: "{{ __('custom.swal.title.error') }}",
                    text: res.msg,
                    icon: 'error',
                });
            }
        }

        // On Event
        $('#mdl_shop_detail').on("hidden.bs.modal", function(e) {
            var mdl = $(this);
            var form = mdl.find('form');

            var input_name = form.find('[name="mdl_input_name"]');
            var input_company_nama = form.find('[name="mdl_input_company_nama"]');
            var input_email = form.find('[name="mdl_input_email"]');
            var input_pwd = form.find('[name="mdl_input_pwd"]');
            var input_no_hp = form.find('[name="mdl_input_no_hp"]');
            var input_no_npwp = form.find('[name="mdl_input_no_npwp"]');
            var input_no_nik = form.find('[name="mdl_input_no_nik"]');

            input_name.val('');
            input_company_nama.val('');
            input_email.val('');
            input_pwd.val('');
            input_no_hp.val('');
            input_no_npwp.val('');
            input_no_nik.val('');
        });

        $('#mdl_shop_type').on("hidden.bs.modal", function(e) {
            var mdl = $(this);
            var form = mdl.find('form');

            var input_type = form.find('[name="mdl_input_type"]');
            var btn_save = form.find('[name="btn_save"]');

            input_type.val('').trigger('change');
            btn_save.off('click');

        });

        // Initial function
        // loadData();
        initTable();
    </script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            // Listen to dispatch from server
            @this.on('showResult', (response) => popResult(table, response));
            @this.on('popShopDetail', (response) => popShopDetail(response));
        });

        document.addEventListener('livewire:navigated', () => {
            // console.log('livewire load code when navigated');
            // Listen to dispatch from server
            Livewire.on('showResult', (response) => popResult(table, response));
            Livewire.on('popShopDetail', (response) => popShopDetail(response));
        });

        document.addEventListener('livewire:navigating', () => {
            // Mutate the HTML before the page is navigated away...
        });
    </script>

@endsection
