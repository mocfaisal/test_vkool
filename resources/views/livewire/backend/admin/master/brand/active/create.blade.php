@section('app.title', 'Brand Active')
@section('content.header.title', 'Brand Active')

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
                            <div class="form-group">
                                <label for="brand_name">Brand Name *</label>
                                <input type="text"
                                    class="form-control @error('brand_name')  {{ $classState }} @enderror"
                                    name="brand_name" placeholder="Brand Name" wire:model.blur="brand_name" required>

                                @error('brand_name')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="brand_image">Image</label>
                                        <input type="file"
                                            class="form-control @error('brand_image') {{ $classState }} @enderror"
                                            name="brand_image" placeholder="Image" accept=".png, .jpg, .jpeg"
                                            wire:model="brand_image">
                                        <span><small class="text-muted">Image format png, jpg, jpeg. Size max
                                                1mb</small></span>

                                        @error('brand_image')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div wire:loading wire:target="brand_image">Uploading...</div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    @if ($brand_image)
                                        <div class="form-group">
                                            <label for="brand_image">Preview Image</label>
                                            <div style="width: 325px;">
                                                <img class="img-fluid" src="{{ $brand_image->temporaryUrl() }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </div>

                        <div class="col-sm-12 d-flex justify-content-end">
                            <div class="buttons">
                                <a href="{{ route('backend.admin.master.brand.active') }}"class="btn btn-secondary"
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
