@section('app.title', 'Product Category')
@section('content.header.title', 'Edit Product Category')

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
            <h4 class="card-title"> Category Level {{ $category_level }} </h4>
            @if ($category_parent_name)
                <h4 class="card-title"> Category Parent Name : {{ $category_parent_name }} </h4>
            @endif
        </div>
        <div class="card-body">
            <div class="form-body">
                <form wire:submit="save" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="category_name">Name *</label>
                                <input type="text"
                                    class="form-control @error('category_name')  {{ $classState }} @enderror"
                                    name="category_name" placeholder="Name" wire:model="category_name"
                                    value="{{ $category_name }}" required>

                                @error('category_name')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status_display">Display *</label>

                                        <select class="form-control form-select" name="status_display"
                                            id="status_display" wire:model="status_display">
                                            <option value="show">Show</option>
                                            <option value="hide">Hide</option>
                                        </select>

                                        @error('status_display')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status_active">Status *</label>

                                        <select class="form-control form-select" name="status_active" id="status_active"
                                            wire:model="status_active">
                                            <option value="Y">Active</option>
                                            <option value="N">Inactive</option>
                                        </select>

                                        @error('status_active')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="category_icon">Icon</label>
                                <input type="file"
                                    class="form-control @error('category_icon') {{ $classState }} @enderror"
                                    name="category_icon" placeholder="Icon" accept="image/png"
                                    wire:model="category_icon">
                                <span><small class="text-muted">Format PNG,</small></span>
                                <span><small class="text-muted">Size max 500KB</small></span>

                                @error('category_icon')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div wire:loading wire:target="category_icon">Uploading...</div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            @if ($category_icon)
                                <div class="form-group">
                                    <label for="category_icon">Preview Image</label>
                                    <div style="width: 325px;">
                                        <img class="img-fluid" src="{{ $category_icon->temporaryUrl() }}">
                                    </div>
                                </div>
                            @elseif($current_icon)
                                <div class="form-group">
                                    <label for="category_icon">Current Image</label>
                                    <div style="width: 325px;">
                                        <img class="img-fluid" src="{{ $current_icon }}">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-12 d-flex justify-content-end">
                            <div class="buttons">
                                <a href="{{ route('backend.admin.master.product.category') }}"class="btn btn-secondary"
                                    wire:navigate>Cancel</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
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
