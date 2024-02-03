@section('app.title', 'Menu')
@section('content.header.title', 'Menu')

<div>
    {{-- Root div must be added --}}

    <div class="row">

        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        <h4 class="card-title">List Menu</h4>
                    </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-outline-secondary" id="btnReload">
                            <i class="fa fa-play"></i> Load Data</button>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="sortableLists list-group" id="myEditor">
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form</h4>
                </div>
                <div class="card-body">

                    <form class="form-horizontal" id="frmEdit">

                        <input type="hidden" class="form-control item-menu" name="id" id="input_id">
                        <input type="hidden" class="form-control item-menu" name="parent_id" id="input_parent_id">
                        <input type="hidden" class="form-control item-menu" name="is_navigated"
                            id="input_is_navigated">

                        <div class="form-group">
                            <label for="text">Text</label>
                            <div class="input-group">
                                <input type="text" class="form-control item-menu" name="text" id="input_text"
                                    placeholder="Text">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary"
                                        id="myEditor_icon"></button>
                                </div>
                            </div>
                            <input type="hidden" class="item-menu" name="icon" id="input_icon">
                        </div>

                        <div class="form-group">
                            <label for="href">URL</label>
                            <input type="text" class="form-control item-menu" name="url" id="input_url"
                                placeholder="URL">
                        </div>

                        <div class="form-group">
                            <label for="is_navigated">IS Navigated</label>
                            <div class="form-check">
                                <div class="checkbox">
                                    <input type="checkbox" class="form-check-input" id="is_navigated">
                                    <label for="is_navigated">Yep</label>
                                </div>
                                <small class="text-muted">SPA Livewire Navigated</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Tooltip</label>
                            <input type="text" class="form-control item-menu" name="title" id="title"
                                placeholder="Tooltip">
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="ket">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control item-menu" name="ket" id="input_ket"
                                    placeholder="Keterangan">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" id="btnUpdate" disabled><i
                            class="fas fa-sync-alt"></i>
                        Update</button>
                    <button type="button" class="btn btn-success" id="btnAdd"><i class="fas fa-plus"></i>
                        Add</button>
                         <button type="button" class="btn btn-warning" onclick="clearForm()"><i class="fas fa-sync"></i>
                        Reset</button>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        <h4 class="card-title">Output</h4>
                    </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-outline-secondary" id="btnOutput">
                            <i class="fa fa-play"></i> Get Output</button>

                        <button type="button" class="btn btn-outline-secondary" id="btn_save">
                            <i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                <div class="card-body">
                    <textarea class="form-control" id="myTextarea" cols="30" rows="10"></textarea>
                </div>
            </div>
        </div>

    </div>

</div>

{{-- Resources --}}
{{-- External Code --}}
@section('private.css.file')
    <link rel="stylesheet" href="{{ asset('assets/backend/extensions') }}/jQuery-Menu-Editor/dist/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css" data-navigate-once>
@endsection

@section('private.js.file')
    <script type="text/javascript" src="{{ asset('assets/backend/extensions') }}/jQuery-Menu-Editor/dist/bootstrap-iconpicker/js/iconset/fontawesome5-15-4.js" data-navigate-once></script>
    <script type="text/javascript" src="{{ asset('assets/backend/extensions') }}/jQuery-Menu-Editor/dist/bootstrap-iconpicker/js/bootstrap-iconpicker.js" data-navigate-once></script>
    <script type="text/javascript" src="{{ asset('assets/backend/extensions') }}/jQuery-Menu-Editor/dist/jquery-menu-editor.js" data-navigate-once> </script>
@endsection

{{-- Internal Code --}}
@section('private.css.code')

@endsection

@section('private.js.code')

    <script data-navigate-once>
        // icon picker options
        var iconPickerOptions = {
            searchText: "Search...",
            labelHeader: "{0} / {1}"
        };

        // sortable list options
        var sortableListOptions = {
            placeholderCss: {
                'background-color': "#cccccc"
            }
        };

        var menuOptions = {
            listOptions: sortableListOptions,
            iconPicker: iconPickerOptions,
            maxLevel: 2,
            autoResetForm: ['edit'] // add [edit, add] to auto reset form after clicked the button
        };

        var editor_menu = new MenuEditor('myEditor', menuOptions);

        editor_menu.setForm($('#frmEdit'));
        editor_menu.setUpdateButton($('#btnUpdate'));

        // declare function

        function initMenu() {
            console.log('init menu loaded');
        }

        function clearForm() {
            $('#frmEdit')[0].reset();
            $('#input_id').val('');
            $('#input_parent_id').val('');
            $('#myEditor_icon').iconpicker('setIcon', 'empty');
        }

        async function saveData(data, is_result = false) {
            var NewData = new FormData();

            NewData.append('dataJson[]', JSON.stringify(data));
            // NewData.append('table', 'menu_json');

            return $.ajax({
                url: "{{ route('backend.admin.settings.menu.update') }}",
                type: "POST",
                dataType: "JSON",
                data: NewData,
                contentType: false,
                cache: false,
                processData: false,
                error: function(response) {
                    let responseJson = response.responseJSON;
                    let listError = responseJson.errors;
                    let listError__ = [];
                    let listVal;

                    let listError_ = Object.keys(listError).reduce((key, val) => {
                        key[val] = listError[val][0];
                        return key;
                    }, {});

                    for (let key in listError_) {
                        let textVal = listError_[key];
                        listError__.push(textVal + "<br>");
                    }

                    let errorMsg = "<b>" + responseJson.message + "</b>";
                    if (listError__) {
                        listVal = listError__.toString().replaceAll(',', '');
                    }

                    $(elem).setButton('reset');

                    Swal.fire({
                        title: "{{ __('custom.swal.title.error') }}",
                        html: errorMsg + "<br>" + listVal,
                        icon: 'error',
                    });
                }
            }).then(function(response) {
                if (is_result) {
                    return response;
                } else {
                    if (response.success) {
                        Swal.fire({
                            title: "{{ __('custom.swal.title.success') }}",
                            text: is_saved.msg,
                            icon: 'success',
                        });
                    } else {
                        Swal.fire({
                            title: "{{ __('custom.swal.title.error') }}",
                            text: response.msg,
                            icon: 'error',
                        });
                    }
                }
            });

        }

        function getData() {
            $.ajax({
                url: "{{ route('backend.admin.settings.menu.data') }}",
                type: "GET",
                dataType: "JSON",
            }).done(function(response) {
                editor_menu.setData([]);

                if (response.data.length != '') {
                    var responses_data = response.data;
                    editor_menu.setData(responses_data);
                }
            });

        }

        // on events

        // Calling the update method
        $("#btnUpdate").click(function() {
            editor_menu.update();
        });

        // load data json to List Menu
        $('#btnReload').click(function() {
            getData();
        });

        // get output of list menu
        $('#btnOutput').click(function() {
            var str = editor_menu.getString();
            $("#myTextarea").text(str);
        });

        $('#btnAdd').click(async function() {

            var input_id = $('#input_id').val();
            var input_parent_id = $('#input_parent_id').val();

            var input_text = $('#input_text').val();
            var input_icon = $('#input_icon').val();
            var input_url = $('#input_url').val();
            var input_ket = $('#input_ket').val();
            var is_navigated = $('#input_is_navigated').val();

            var data = {
                id: 0,
                parent_id: 0,
                text: input_text,
                icon: input_icon,
                url: input_url,
                ket: input_ket,
                is_navigated: is_navigated,
            };

            var is_saved = await saveData(data, true);

            if (is_saved.success) {
                Swal.fire({
                    title: "{{ __('custom.swal.title.success') }}",
                    text: is_saved.msg,
                    icon: 'success',
                    confirmButtonText: "{{ __('custom.swal.button.ok') }}",
                }).then((result) => {
                    if (result.isConfirmed) {
                        editor_menu.add();
                        clearForm();
                        getData();
                    }
                });
            } else {
                Swal.fire({
                    title: "{{ __('custom.swal.title.error') }}",
                    text: is_saved.msg,
                    icon: 'error',
                });
            }
        });

        $('#btn_save').on('click', async function(e) {
            var str = JSON.parse(editor_menu.getString());
            var is_saved = await saveData(str, true);
            if (is_saved.success) {
                Swal.fire({
                    title: "{{ __('custom.swal.title.success') }}",
                    text: is_saved.msg,
                    icon: 'success',
                    confirmButtonText: "{{ __('custom.swal.button.ok') }}",
                }).then((result) => {
                    if (result.isConfirmed) {
                        clearForm();
                        getData();
                    }
                });
            } else {
                Swal.fire({
                    title: "{{ __('custom.swal.title.error') }}",
                    text: response.msg,
                    icon: 'error',
                });
            }
        });

        $('#is_navigated').on('change', function(e) {
            var ini = $(this);
            var value = 0;

            if (ini.prop('checked')) {
                value = 1;
            } else {
                value = 0;
            }
            $('#input_is_navigated').val(value);
        });

        // NOTE Manually bind events
        $('#myEditor').on('click', '.btnEdit', function(e) {
            var ini = $(this);
            var itemEditing = $(this).closest('li');

            var data = itemEditing.data();
            // console.log(data);

            // variables
            var is_navigated = data.is_navigated;

            // input elements
            var input_is_navigated = $('#is_navigated');

            if (is_navigated == 1) {
                input_is_navigated.prop('checked', true);
            } else {
                input_is_navigated.prop('checked', false);
            }
        });
    </script>

    {{-- <script data-navigate-once>
        document.addEventListener('livewire:init', () => {
            // Runs after Livewire is loaded but before it's initialized
            // on the page...
            // initMenu();
            console.log('livewire before init');
        });

        document.addEventListener('livewire:initialized', () => {
            // Runs immediately after Livewire has finished initializing
            // on the page...
            // console.log('livewire after init');
            console.log('livewire load code when init');
            // initMenu();


        });

        document.addEventListener('livewire:navigated', () => {
            console.log('livewire load code when navigated');
            // initMenu();

        });
    </script> --}}

@endsection
