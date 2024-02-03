@section('app.title', 'LPSE Management')
@section('content.header.title', 'LPSE Management')

<div>
    {{-- Root div must be added --}}

    <div class="card">
        <div class="card-body">
            <div class="accordion" id="acc_parent">

                <div class="accordion-item">
                    <h2 class="accordion-header" id="acc_head_1">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#acc_col_1" aria-expanded="false" aria-controls="acc_col_1">
                            Pricing Formulation
                        </button>
                    </h2>
                    <div class="accordion-collapse collapse" id="acc_col_1" data-bs-parent="#acc_parent"
                        aria-labelledby="acc_head_1">
                        <div class="accordion-body">

                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">PPH (%)</label>
                                        <input type="text" class="form-control mask-percent" name="input_pph"
                                            id="input_pph" placeholder="PPN (%)" wire:model="input_pph">
                                        <small class="text-muted">Percentage Max 99.99%</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">PPN (%)</label>
                                        <input type="text" class="form-control mask-percent" name="input_ppn"
                                            id="input_ppn" placeholder="PPN (%)" wire:model="input_ppn">
                                        <small class="text-muted">Percentage Max 99.99%</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Fee Nominal MP</label>
                                        <input type="text" class="form-control mask-nominal"
                                            name="input_fee_mp_nominal" id="input_fee_mp_nominal"
                                            placeholder="Fee Nominal MP" wire:model="input_fee_mp_nominal">
                                        <small class="text-muted">Fee Nominal MP</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Fee Percent MP (%)</label>
                                        <input type="text" class="form-control mask-percent"
                                            name="input_fee_mp_percent" id="input_fee_mp_percent"
                                            placeholder="Fee Percent MP (%)" wire:model="input_fee_mp_percent">
                                        <small class="text-muted">Percentage Max 99.99%</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Fee Nominal Payment Gateway</label>
                                        <input type="text" class="form-control mask-nominal"
                                            name="input_fee_pg_nominal" id="input_fee_pg_nominal"
                                            placeholder="Fee Nominal Payment Gateway" wire:model="input_fee_pg_nominal">
                                        <small class="text-muted">Fee Nominal Payment Gateway</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Fee Percent Payment Gateway (%)</label>
                                        <input type="text" class="form-control mask-percent"
                                            name="input_fee_pg_percent" id="input_fee_pg_percent"
                                            placeholder="Fee Percent Payment Gateway (%)"
                                            wire:model="input_fee_pg_percent">
                                        <small class="text-muted">Percentage Max 99.99%</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Maximum direct purchase limit</label>
                                        <input type="text" class="form-control mask-nominal"
                                            name="input_max_price_limit" id="input_max_price_limit"
                                            placeholder="Maximum direct purchase limit"
                                            wire:model="input_max_price_limit">
                                        <small class="text-muted">Maximum direct purchase limit</small>
                                    </div>
                                </div>

                            </div>

                            <div class="buttons">
                                <button type="button" class="btn btn-primary icon icon-left" id="btn_save_formula"
                                    onclick="savePrice()"><i class="bi bi-floppy"></i> Save</button>
                            </div>
                            <small class="text-muted">*Press Spacebar to update the value formatting</small>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="acc_head_2">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#acc_col_2" aria-expanded="false" aria-controls="acc_col_2">
                            Simulation Pricing Formulation
                        </button>
                    </h2>
                    <div class="accordion-collapse collapse" id="acc_col_2" data-bs-parent="#acc_parent"
                        aria-labelledby="acc_head_2">
                        <div class="accordion-body">

                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Price Seller Input</label>
                                        <input type="text" class="form-control mask-nominal"
                                            name="input_demo_price" id="input_demo_price"
                                            placeholder="Price Seller Input" wire:model="input_demo_price">
                                        <small class="text-muted">Input Price</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Fee Marketplace</label>
                                        <input type="text" class="form-control mask-nominal"
                                            name="input_demo_fee_mp" id="input_demo_fee_mp"
                                            placeholder="Fee Marketplace" wire:model="input_demo_fee_mp" readonly
                                            disabled>
                                        <small class="text-muted">Fee Marketplace</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Base Price LPSE</label>
                                        <input type="text" class="form-control mask-nominal"
                                            name="input_demo_base_price" id="input_demo_base_price"
                                            placeholder="Base Price LPSE" wire:model="input_demo_base_price" readonly
                                            disabled>
                                        <small class="text-muted">Base Price LPSE</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">PPN</label>
                                        <input type="text" class="form-control mask-nominal" name="input_demo_ppn"
                                            id="input_demo_ppn" placeholder="PPN" wire:model="input_demo_ppn"
                                            readonly disabled>
                                        <small class="text-muted">PPN</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Display Price LPSE</label>
                                        <input type="text" class="form-control mask-nominal"
                                            name="input_demo_display_price" id="input_demo_display_price"
                                            placeholder="Display Price LPSE" wire:model="input_demo_display_price"
                                            readonly disabled>
                                        <small class="text-muted">Display Price LPSE</small>
                                    </div>
                                </div>

                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Debug Calc</label>
                                        <input type="text" class="form-control" wire:model="calc_output"
                                            readonly />
                                    </div>
                                </div> --}}

                            </div>

                            <div class="buttons">
                                <button type="button" class="btn btn-primary icon icon-left" id="btn_calc_demo"
                                    onclick="calcDemo()"><i class="bi bi-calculator-fill"></i> Calculate</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">List LPSE Shop</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="field_table"></div>
        </div>
    </div>

</div>

@section('modal')
    <div class="modal fade text-left" id="mdl_perm_att" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Permission Attachment </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <i
                            data-feather="x"></i> </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link active" id="attachment-1-tab" data-bs-toggle="tab"
                                data-bs-target="#attachment-1-pane"
                                role="tab">{{ __('custom.attachment.permission.deed_of_amendment') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link" id="attachment-2-tab" data-bs-toggle="tab"
                                data-bs-target="#attachment-2-pane"
                                role="tab">{{ __('custom.attachment.permission.deed_of_incorporation') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link" id="attachment-3-tab" data-bs-toggle="tab"
                                data-bs-target="#attachment-3-pane"
                                role="tab">{{ __('custom.attachment.permission.business_registration_number') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link" id="attachment-4-tab" data-bs-toggle="tab"
                                data-bs-target="#attachment-4-pane"
                                role="tab">{{ __('custom.attachment.permission.taxpayer_identification_number') }}*</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link" id="attachment-5-tab" data-bs-toggle="tab"
                                data-bs-target="#attachment-5-pane"
                                role="tab">{{ __('custom.attachment.permission.taxable_entrepreneurs') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link" id="attachment-6-tab" data-bs-toggle="tab"
                                data-bs-target="#attachment-6-pane"
                                role="tab">{{ __('custom.attachment.permission.id_card') }}*</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="attachment-1-pane" role="tabpanel" tabindex="0">
                            <iframe id="attachment-1-file" src="" style="width:100%;"></iframe>
                        </div>
                        <div class="tab-pane fade" id="attachment-2-pane" role="tabpanel" tabindex="0">
                            <iframe id="attachment-2-file" src="" style="width:100%;"></iframe>
                        </div>
                        <div class="tab-pane fade" id="attachment-3-pane" role="tabpanel" tabindex="0">
                            <iframe id="attachment-3-file" src="" style="width:100%;"></iframe>
                        </div>
                        <div class="tab-pane fade" id="attachment-4-pane" role="tabpanel" tabindex="0">
                            <iframe id="attachment-4-file" src="" style="width:100%;"></iframe>
                        </div>
                        <div class="tab-pane fade" id="attachment-5-pane" role="tabpanel" tabindex="0">
                            <iframe id="attachment-5-file" src="" style="width:100%;"></iframe>
                        </div>
                        <div class="tab-pane fade" id="attachment-6-pane" role="tabpanel" tabindex="0">
                            <iframe id="attachment-6-file" src="" style="width:100%;"></iframe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <small class="text-muted">* Are mandatory</small>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info"id="mdl_perm_btn_email">Send Email</button>
                        <button type="button" class="btn btn-success" id="mdl_perm_btn_approve" disabled>Approve
                            Document</button>
                        {{-- <button type="button" class="btn btn-danger">Wait for Document</button> --}}
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade text-left" id="mdl_perm_email_doc" tabindex="-1" role="dialog" aria-hidden="true"
        style="background-color: rgb(0 0 0 / 50%);">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">List of Documents that need to be updated</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <i
                            data-feather="x"></i> </button>
                </div>
                <div class="modal-body">

                    <form id="frm_perm_email">

                        <div class="form-check">
                            <div class="checkbox">
                                <input type="checkbox" class="form-check-input" id="input_doc_all">
                                <label>Select All</label>
                            </div>
                        </div>

                        <hr>

                        <div class="form-check">
                            <div class="checkbox">
                                <input type="checkbox" class="form-check-input" name="input_doc[1]">
                                <label>{{ __('custom.attachment.permission.deed_of_amendment') }}</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div class="checkbox">
                                <input type="checkbox" class="form-check-input" name="input_doc[2]">
                                <label>{{ __('custom.attachment.permission.deed_of_incorporation') }}</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div class="checkbox">
                                <input type="checkbox" class="form-check-input" name="input_doc[3]">
                                <label>{{ __('custom.attachment.permission.business_registration_number') }}</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div class="checkbox">
                                <input type="checkbox" class="form-check-input" name="input_doc[4]">
                                <label>{{ __('custom.attachment.permission.taxpayer_identification_number') }}*</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div class="checkbox">
                                <input type="checkbox" class="form-check-input" name="input_doc[5]">
                                <label>{{ __('custom.attachment.permission.taxable_entrepreneurs') }}</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div class="checkbox">
                                <input type="checkbox" class="form-check-input" name="input_doc[6]">
                                <label>{{ __('custom.attachment.permission.id_card') }}*</label>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">

                    <div class="btn-group">
                        <button type="button" class="btn btn-info"id="mdl_perm_doc_btn_email">Send Email</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
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
                '<table id="tbl_list" class="table-striped table-hover table table" style="width: 100%;"> <thead> <tr> <th style="vertical-align: middle; text-align: center;">No.</th> <th style="vertical-align: middle; text-align: center;">Shop Name</th> <th style="vertical-align: middle; text-align: center;">Type</th> <th style="vertical-align: middle; text-align: center;">Join Date</th> <th style="vertical-align: middle; text-align: center;">T.O.P</th> <th style="vertical-align: middle; text-align: center;">Action</th> </tr> </thead> </table>';
            field_table.html(txt);
            return true;
        }

        async function loadData(dataPost = null) {
            var tbl_link = "{{ route('backend.admin.lpse.management.getData.table') }}";

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
                        data: 'type',
                        searchable: false
                    },
                    {
                        data: 'join_date',
                        searchable: false
                    }, {
                        data: 'is_top',
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                    className: 'dt-center',
                    targets: [0, 2, 3, 4, 5]
                }, ],
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

        function savePrice() {
            var input_pph = $('#input_pph').val();
            var input_ppn = $('#input_ppn').val();
            var input_fee_mp_nominal = $('#input_fee_mp_nominal').val();
            var input_fee_mp_percent = $('#input_fee_mp_percent').val();
            var input_fee_pg_nominal = $('#input_fee_pg_nominal').val();
            var input_fee_pg_percent = $('#input_fee_pg_percent').val();
            var input_max_price_limit = $('#input_max_price_limit').val();

            var params = {
                pph: input_pph,
                ppn: input_ppn,
                fee_mp_nominal: input_fee_mp_nominal,
                fee_mp_percent: input_fee_mp_percent,
                fee_pg_nominal: input_fee_pg_nominal,
                fee_pg_percent: input_fee_pg_percent,
                max_price_limit: input_max_price_limit,
            };

            @this.call('savePriceConfig', params);
        }

        function calcDemo() {
            var input_pph = $('#input_pph').val();
            var input_ppn = $('#input_ppn').val();
            var input_fee_mp_nominal = $('#input_fee_mp_nominal').val();
            var input_fee_mp_percent = $('#input_fee_mp_percent').val();
            var input_fee_pg_nominal = $('#input_fee_pg_nominal').val();
            var input_fee_pg_percent = $('#input_fee_pg_percent').val();
            var input_demo_price = $('#input_demo_price').val();
            // var input_max_price_limit = $('#input_max_price_limit').val();

            var params = {
                pph: input_pph,
                ppn: input_ppn,
                fee_mp_nominal: input_fee_mp_nominal,
                fee_mp_percent: input_fee_mp_percent,
                fee_pg_nominal: input_fee_pg_nominal,
                fee_pg_percent: input_fee_pg_percent,
                demo_price: input_demo_price,
                // max_price_limit: input_max_price_limit,
            };

            @this.call('calc_demo', params);

            // await @this.call('getData_shop_detail', shop_id).then(result => {
            //     $(elem).setButton('reset');
            // });

        }

        function popTop(id, cond) {
            Swal.fire({
                title: "{{ __('custom.swal.title.confirm', ['first' => 'update', 'second' => 'T.O.P']) }}",
                showDenyButton: true,
                confirmButtonText: "{{ __('custom.swal.button.yes') }}",
                denyButtonText: "{{ __('custom.swal.button.no') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    var params = {
                        shop_id: id,
                        is_top: cond
                    };

                    @this.call('update_top', params);
                }

            })
        }

        function popPermAtt(id) {
            let element = $('#mdl_perm_att');
            // const component = new bootstrap.Modal(element)

            @this.call('get_attachment', id).then(function(response) {
                // console.log(response);
                element.data('id', id);
                let elem_title = element.find('.modal-title');
                let curr_title = elem_title.text();
                let btn_approve = $('#mdl_perm_btn_approve');

                elem_title.text(curr_title + ' - ' + response.data.shop_name);

                if (response.success) {
                    if (response.data) {
                        let is_approved = response.data.is_approved;
                        let data_attachment = response.data.attachment;

                        let akta_perubahan = data_attachment.akta_perubahan;
                        let akta_pendirian = data_attachment.akta_pendirian;
                        let nib = data_attachment.nib;
                        let npwp = data_attachment.npwp;
                        let pkp = data_attachment.pkp;
                        let ktp = data_attachment.ktp;

                        if (akta_perubahan) {
                            $('#attachment-1-file').prop('src', akta_perubahan);
                            $('#attachment-1-tab').setButtonAvail(true);
                        } else {
                            $('#attachment-1-tab').setButtonAvail(false);
                        }

                        if (akta_pendirian) {
                            $('#attachment-2-file').prop('src', akta_pendirian);
                            $('#attachment-2-tab').setButtonAvail(true);
                        } else {
                            $('#attachment-2-tab').setButtonAvail(false);
                        }

                        if (nib) {
                            $('#attachment-3-file').prop('src', nib);
                            $('#attachment-3-tab').setButtonAvail(true);
                        } else {
                            $('#attachment-3-tab').setButtonAvail(false);
                        }

                        if (npwp) {
                            $('#attachment-4-file').prop('src', npwp);
                            $('#attachment-4-tab').setButtonAvail(true);
                        } else {
                            $('#attachment-4-tab').setButtonAvail(false);
                        }

                        if (pkp) {
                            $('#attachment-5-file').prop('src', pkp);
                            $('#attachment-5-tab').setButtonAvail(true);
                        } else {
                            $('#attachment-5-tab').setButtonAvail(false);
                        }

                        if (ktp) {
                            $('#attachment-6-file').prop('src', ktp);
                            $('#attachment-6-tab').setButtonAvail(true);
                        } else {
                            $('#attachment-6-tab').setButtonAvail(false);
                        }

                        if (is_approved) {
                            btn_approve.prop('disabled', true);
                        } else {
                            btn_approve.prop('disabled', false);
                        }
                    }
                }
            });

            // component.show();
            element.modal('show');

        }

        function initMasking() {
            $('.mask-percent').mask("00.09", {
                reverse: true,
                placeholder: "99.99"
            });

            $('.mask-nominal').mask("#,##0", {
                reverse: true
            });
        }

        // Initial Plugin


        // On Events
        $('#mdl_perm_att').on('hidden.bs.modal', e => {
            let element = $('#mdl_perm_att');

            let elem_title = element.find('.modal-title');
            let curr_title = elem_title.text();
            let btn_approve = $('#mdl_perm_btn_approve');

            let titleExp = curr_title.split(' - ');
            let new_title = titleExp[0];
            elem_title.text(new_title);
            element.data('id', '');

            $('#attachment-1-tab').tab('show');
            btn_approve.prop('disabled', true);
        });

        $('#mdl_perm_email_doc').on('hidden.bs.modal', e => {
            let element = $('#mdl_perm_email_doc');
            element.data('id', '');
        });

        $('#mdl_perm_btn_approve').on('click', e => {
            let element = $('#mdl_perm_att');
            let data_id = element.data('id');

            Swal.fire({
                title: "{{ __('custom.swal.title.confirm', ['first' => 'update', 'second' => 'Document']) }}",
                showDenyButton: true,
                confirmButtonText: "{{ __('custom.swal.button.yes') }}",
                denyButtonText: "{{ __('custom.swal.button.no') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    var params = {
                        shop_id: data_id,
                        stat: 1
                    };

                    @this.call('update_document_permission', params).then(function(response) {
                        element.modal('hide');
                    });
                }

            })
        });

        $('#mdl_perm_btn_email').on('click', e => {
            let element = $('#mdl_perm_att');
            let element2 = $('#mdl_perm_email_doc');

            let data_id = element.data('id');
            element2.data('id', data_id);

            element2.modal('show');

        });

        $('#mdl_perm_doc_btn_email').on('click', e => {
            let element = $('#mdl_perm_att');
            let element2 = $('#mdl_perm_email_doc');
            let form = $('#frm_perm_email');

            let data_id = element2.data('id');
            let data_form = form.serializeArray();

            @this.call('send_email', data_form, data_id).then(function(response) {
                console.log(response);
                if (response.success) {
                    Swal.fire({
                        title: 'Success',
                        text: response.msg,
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {}
                        element2.modal('hide');
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.msg,
                        icon: 'error',
                    });
                }
            });

        });

        $('#input_doc_all').on('change', e => {
            var ini = $('#input_doc_all');
            let element = $('[name*="input_doc"]');

            if (ini.prop('checked')) {
                element.prop('checked', true);
            } else {
                element.prop('checked', false);
            }
        });


        // Initial function
        initTable();

        $(function() {
            initMasking();
        });
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
