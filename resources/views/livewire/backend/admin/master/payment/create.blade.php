@section('app.title', 'Payment')
@section('content.header.title', 'Add Payment')

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
                <form wire:submit="save" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="payment_name">Payment Name *</label>
                                        <input type="text"
                                            class="form-control @error('payment_name')  {{ $classState }} @enderror"
                                            name="payment_name" placeholder="Payment Name"
                                            wire:model.blur="payment_name" required>

                                        @error('payment_name')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="payment_device">Device Type *</label>
                                        <select class="form-control form-select" name="payment_device"
                                            wire:model="payment_device">
                                            <option value="all">All Devices</option>
                                            <option value="mobile">Only Mobile</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <label for="payment_fee_nominal">Fee</label>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <input type="number"
                                            class="form-control @error('payment_fee_nominal')  {{ $classState }} @enderror"
                                            name="payment_fee_nominal" placeholder="Fee Nominal"
                                            wire:model.blur="payment_fee_nominal" required>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <input type="number"
                                            class="form-control @error('payment_fee_percent')  {{ $classState }} @enderror"
                                            name="payment_fee_percent" placeholder="Fee Percent"
                                            wire:model.blur="payment_fee_percent" required>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="payment_code">Payment Code</label>
                                        <input type="text"
                                            class="form-control @error('payment_code')  {{ $classState }} @enderror"
                                            name="payment_code" placeholder="Payment Code"
                                            wire:model.blur="payment_code">

                                        <span><small class="text-muted">Filled by developer.</small></span>
                                        <span><small class="text-muted">Set empty to generate.</small></span>

                                        @error('payment_code')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="payment_flag">Flag</label>
                                        <select class="form-control form-select" name="payment_flag"
                                            wire:model="payment_flag">
                                            <option value="jokul">Jokul</option>
                                            <option value="module">Module</option>
                                        </select>
                                        <span><small class="text-muted">Filled by developer.</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="payment_image">Image</label>
                                        <input type="file"
                                            class="form-control @error('payment_image') {{ $classState }} @enderror"
                                            name="payment_image" placeholder="Image" accept="image/png"
                                            wire:model="payment_image">
                                        <span><small class="text-muted">Resolution max 325x325 px</small></span>

                                        @error('payment_image')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div wire:loading wire:target="payment_image">Uploading...</div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    @if ($payment_image)
                                        <div class="form-group">
                                            <label for="payment_image">Preview Image</label>
                                            <div style="width: 325px;">
                                                <img class="img-fluid" src="{{ $payment_image->temporaryUrl() }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </div>

                        <div class="col-sm-12 d-flex justify-content-end">
                            <div class="buttons">
                                <a href="{{ route('backend.admin.master.payment') }}"class="btn btn-secondary"
                                    wire:navigate>Cancel</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
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
            document.addEventListener('livewire:initialized', () => {
                @this.on('showResult', (response) => popResult2(response));
            });

            document.addEventListener('livewire:navigated', () => {
                // console.log('livewire load code when navigated');
                Livewire.on('showResult', (response) => popResult2(response));
            });
        </script>

    @endsection
