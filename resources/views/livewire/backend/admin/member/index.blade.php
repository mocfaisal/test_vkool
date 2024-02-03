@section('app.title', 'Member')
@section('content.header.title', 'Member')

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
                        <label class="form-label" for="input_email">Email</label>
                        <input type="email" class="form-control" name="input_email" id="input_email">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label" for="input_phone">Phone</label>
                        <input type="text" class="form-control" name="input_phone" id="input_phone">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label" for="input_status">Status</label>
                        <select class="form-control form-select" name="input_status" id="input_status">
                            <option value="">All</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="suspend">Suspend</option>
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
    <div class="modal fade text-left" id="mdl_detail_member" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="mdl_detail_member_label" aria-hidden="true">
        <div class="modal-dialog modal-full modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdl_detail_member_label">
                        Detail Member
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
                                    <label for="mdl_input_nama">Nama</label>
                                    <input type="text" class="form-control" name="mdl_input_nama" placeholder="Nama"
                                        readonly>
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
                                    <label for="mdl_input_jk">Jenis Kelamin</label>
                                    <input type="text" class="form-control" name="mdl_input_jk"
                                        placeholder="Jenis Kelamin" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_tgl_lahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control" name="mdl_input_tgl_lahir"
                                        placeholder="Tanggal Lahir" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_no_hp">Nomor Handphone</label>
                                    <input type="text" class="form-control" name="mdl_input_no_hp"
                                        placeholder="Nomor Handphone" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_no_npwp">NPWP Instansi</label>
                                    <input type="text" class="form-control" name="mdl_input_no_npwp"
                                        placeholder="NPWP Instansi" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_satker">Satuan Kerja</label>
                                    <input type="text" class="form-control" name="mdl_input_satker"
                                        placeholder="satker" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_instansi">Instansi</label>
                                    <input type="text" class="form-control" name="mdl_input_instansi"
                                        placeholder="Instansi" readonly>
                                </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="mdl_input_alamat_instansi">Alamat Instansi</label>
                                    <input type="text" class="form-control" name="mdl_input_alamat_instansi"
                                        placeholder="Alamat Instansi" readonly>
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
                '<table class="table-striped table-hover table table" id="tbl_list" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;">No.</th> <th style="vertical-align: middle; text-align: center;">Name</th> <th style="vertical-align: middle; text-align: center;">Email</th> <th style="vertical-align: middle; text-align: center;">Phone</th> <th style="vertical-align: middle; text-align: center;">Status</th> <th style="vertical-align: middle; text-align: center;">Action</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData(dataPost = null) {
            var tbl_link = "{{ route('backend.admin.member.getData.table') }}";

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
                        data: 'fullname',
                    }, {
                        data: 'email',
                    },
                    {
                        data: 'no_hp',
                    }, {
                        data: 'member_status',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    className: 'dt-center',
                    targets: [0, 4, 5]
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
            var input_email = $('#input_email').val();
            var input_phone = $('#input_phone').val();
            var input_status = $('#input_status').val();

            newData["find"] = {
                "name": input_name,
                "email": input_email,
                "phone": input_phone,
                "status": input_status,
            };

            loadData(newData);

            $(elem).setButton('reset');
        }

        async function get_detail_member(elem, member_id) {

            $(elem).setButton('loading', false);

            await @this.call('getData_member_detail', member_id).then(result => {
                $(elem).setButton('reset');
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

        function popMemberDetail(response) {
            let res = response.result;

            var mdl = $('#mdl_detail_member');
            var NewData = new FormData();
            var form = mdl.find('form');

            var input_email = form.find('[name="mdl_input_email"]');
            var input_satker = form.find('[name="mdl_input_satker"]');
            var input_instansi = form.find('[name="mdl_input_instansi"]');
            var input_nama = form.find('[name="mdl_input_nama"]');
            var input_no_hp = form.find('[name="mdl_input_no_hp"]');
            var input_no_npwp = form.find('[name="mdl_input_no_npwp"]');
            var input_alamat_instansi = form.find('[name="mdl_input_alamat_instansi"]');
            var input_jk = form.find('[name="mdl_input_jk"]');
            var input_tgl_lahir = form.find('[name="mdl_input_tgl_lahir"]');

            if (res.success) {
                let data = res.data;

                input_email.val(data.email);
                input_satker.val(data.satker);
                input_instansi.val(data.instansi);
                input_nama.val(data.fullname);
                input_no_hp.val(data.no_hp);
                input_no_npwp.val(data.npwp);
                input_alamat_instansi.val(data.npwp_address);
                input_jk.val(data.jenis_kelamin);
                input_tgl_lahir.val(data.tgl_lahir);

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
        $('#mdl_detail_member').on("hidden.bs.modal", function(e) {
            var mdl = $(this);
            var form = mdl.find('form');

            var input_email = form.find('[name="mdl_input_email"]');
            var input_satker = form.find('[name="mdl_input_satker"]');
            var input_instansi = form.find('[name="mdl_input_instansi"]');
            var input_nama = form.find('[name="mdl_input_nama"]');
            var input_no_hp = form.find('[name="mdl_input_no_hp"]');
            var input_no_npwp = form.find('[name="mdl_input_no_npwp"]');
            var input_alamat_instansi = form.find('[name="mdl_input_alamat_instansi"]');
            var input_jk = form.find('[name="mdl_input_jk"]');
            var input_tgl_lahir = form.find('[name="mdl_input_tgl_lahir"]');

            input_email.val("");
            input_satker.val("");
            input_instansi.val("");
            input_nama.val("");
            input_no_hp.val("");
            input_no_npwp.val("");
            input_alamat_instansi.val("");
            input_jk.val("");
            input_tgl_lahir.val("");
        });

        // Initial function
        // loadData();
        initTable();
    </script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            // Listen to dispatch from server
            @this.on('showResult', (response) => popResult(table, response));
            @this.on('popMemberDetail', (response) => popMemberDetail(response));
        });

        document.addEventListener('livewire:navigated', () => {
            // console.log('livewire load code when navigated');
            // Listen to dispatch from server
            Livewire.on('showResult', (response) => popResult(table, response));
            Livewire.on('popMemberDetail', (response) => popMemberDetail(response));
        });

        document.addEventListener('livewire:navigating', () => {
            // Mutate the HTML before the page is navigated away...
        });
    </script>

@endsection
