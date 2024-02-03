@section('app.title', 'Free Shipping Area')
@section('content.header.title', 'Free Shipping Area')

@php

    $classState = '';
    $classFeedbackState = '';

    if ($errors->any()) {
        $classState = 'is-invalid';
        $classFeedbackState = 'invalid-feedback';
    }

@endphp

<div>
    {{-- Root div must be added --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Add Data </h4>
        </div>
        <div class="card-body">
            <div class="form-body">
                <form wire:submit="save">
                    <div class="row">

                        @foreach ($listInput as $val)
                            <div class="row" wire:key="data-{{ $val }}">
                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <label for="input_province.{{ $val }}">Province</label>
                                        <select class="form-select input_province"
                                            name="input_province.{{ $val }}" data-key="{{ $val }}"
                                            wire:model="input_province.{{ $val }}" required
                                            wire:change="get_city({{ $val }},$event.target.value)">
                                            <option value="">Select Province</option>
                                            @foreach ($list_province as $keyb => $valb)
                                                <option value="{{ $valb->province_id }}">
                                                    {{ $valb->province_name }}</option>
                                            @endforeach
                                        </select>

                                        @error("input_province.$val")
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <label for="input_city.{{ $val }}">City</label>
                                        <select class="form-select input_city"
                                            name="input_city.{{ $val }}"
                                            wire:model="input_city.{{ $val }}" required>
                                            <option value="">Select City</option>
                                            @if (!empty($list_city))
                                                @foreach ($list_city[$val] as $keyc => $valc)
                                                    <option value="{{ $valc->city_id }}">
                                                        {{ $valc->city_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @error("input_city.$val")
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label for=""></label>
                                    <div class="form-group">
                                        @if ($val == 1)
                                            <button type="button" class="btn btn-success icon" wire:click="addInput"><i
                                                    class="bi bi-plus"></i></button>
                                        @else
                                            <button type="button" class="btn btn-danger icon"
                                                wire:click="removeInput({{ $val }})"><i
                                                    class="bi bi-trash"></i></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="col-sm-12 d-flex justify-content-end">
                        <div class="buttons">
                            <a href="{{ route('backend.admin.master.shipping.free_area') }}"class="btn btn-secondary"
                                wire:navigate>Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>

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
            // async function get_city(iterate, prov_id) {
            //     var result = await @this.call('get_city', iterate, prov_id).then();

            // }

            document.addEventListener('livewire:initialized', () => {
                @this.on('showResult', (response) => popResult2(response));
                // @this.on('initSelect', (event) => initSelect2());
            });

            document.addEventListener('livewire:navigated', () => {
                // console.log('livewire load code when navigated');
                Livewire.on('showResult', (response) => popResult2(response));
                // Livewire.on('initSelect', (event) => initSelect2());
            });

            // document.addEventListener('livewire:init', () => {
            //     Livewire.hook('morph.updated', ({
            //         el,
            //         component
            //     }) => {
            //         // console.log(component);

            //     });
            // });

            // $('.input_province').on('change', function(e) {
            //     let iterate = $(this).data('key');
            //     let selectedValue = $(this).val();

            //     console.log(iterate, selectedValue);
            //     get_city(iterate, selectedValue);

            //     // Livewire.dispatch('listenerProvince', iterate, selectedValue);
            // });

            // function initSelect2() {
            //     $('.select2').select2().select2('destroy').select2({
            //         minimumInputLength: -1,
            //         allowClear: true,
            //     });
            // }

            // document.addEventListener('livewire:load', function() {
            //     // Initialize Select2 for the initial select elements
            //     $('.select2').select2();

            //     Livewire.hook('element.updated', (el, component) => {

            //         console.log('element updated');

            //         // Check if the updated element is a select input with the .select2 class
            //         if (el.tagName === 'SELECT' && el.classList.contains('select2')) {
            //             // Initialize Select2 for the updated select input
            //             $(el).select2();
            //         }
            //     });

            //     // Listen for the 'dom:updated' event and reinitialize Select2 when it's fired
            //     // Livewire.hook('message.sent', (message, component) => {
            //     //     if (message.type === 'mutation') {
            //     //         // Check if the updated element is a select input with the .select2 class
            //     //         $('.select2', message.el).select2();
            //     //     }
            //     // });
            // });
        </script>

{{--
<script>
    // document.addEventListener('livewire:load', function() {

    //     $('.select2').select2();

    //     Livewire.on('initSelect2', function() {
    //         // Reinitialize Select2 for all select elements
    //         $('.select2').select2();
    //     });

    // });

    $('.input_province').on('change', function(e) {
        let iterate = $(this).data('key');
        let selectedValue = $(this).val();

        @this.call('get_city', iterate, selectedValue);
        // @this.dispatch('initSelect2');

        console.log(iterate, selectedValue);

        // $(this).val(@json($input_province));

        initSelect2()
    });

    // $(function() {

    // $('.input_province').on('change', function(e) {
    //     let iterate = $(this).data('key');
    //     let selectedValue = $(this).val();

    //     // console.log(iterate, selectedValue);

    //     @this.call('get_city', iterate, selectedValue);
    //     @this.dispatch('initSelect2');

    //     //             Livewire.dispatch('listenerProvince', iterate, selectedValue);
    // });

    // });

    document.addEventListener('livewire:initialized', () => {
        @this.on('showResult', (response) => popResult2(response));
        @this.on('initSelect2', (event) => initSelect2());

        //     $('.input_province').on('change', function(e) {
        //         let iterate = $(this).data('key');
        //         let selectedValue = $(this).val();
        //         @this.set('input_province.' + iterate, selectedValue);

        //         console.log(iterate);
    });


    // });

    document.addEventListener('livewire:navigated', () => {
        // console.log('livewire load code when navigated');
        Livewire.on('showResult', (response) => popResult2(response));
        Livewire.on('initSelect2', (event) => initSelect2());
    });

    function initSelect2() {
        $('.select2').select2({
            minimumInputLength: -1,
            allowClear: true,
        });
    }


    // document.addEventListener('livewire:init', () => {
    //     Livewire.hook('component.init', ({ component, cleanup  }) => {
    //         console.log(component);
    //         // console.log(1);
    //         //         $('.input_province').on('change', function(e) {
    //         //             let iterate = $(this).data('key');
    //         //             let selectedValue = $(this).val();

    //         //             console.log(iterate, selectedValue);

    //         //             Livewire.dispatch('listenerProvince', iterate, selectedValue);
    //         //         });


    //         // initSelect2();
    //     });

    // });
</script> --}}

    @endsection
