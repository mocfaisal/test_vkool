@section('app.title', 'Promo Content - Add')
@section('content.header.title', 'Promo Content - Add')

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
                                <label for="category_name">Category Name *</label>
                                <select class="form-select" name="category_name" wire:model.lazy="category_name" required>
                                    <option value="" >Select Promo Category</option>
                                    @foreach ($category_list as $val)
                                        <option value="{{ $val->id }}" wire:key="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>

                                @error('category_name')
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
                                        <label for="content_image">Image</label>
                                        <input type="file"
                                            class="form-control @error('content_image') {{ $classState }} @enderror"
                                            name="content_image" placeholder="Image" accept=".png"
                                            wire:model="content_image">
                                        <span><small class="text-muted">Image format png, jpg.</small></span>

                                        @error('content_image')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div wire:loading wire:target="content_image">Uploading...</div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    @if ($content_image)
                                        <div class="form-group">
                                            <label for="content_image">Preview Image</label>
                                            <div style="width: 325px;">
                                                <img class="img-fluid" src="{{ $content_image->temporaryUrl() }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </div>

                        <div class="col-sm-12 d-flex justify-content-end">
                            <div class="buttons">
                                <a href="{{ route('backend.admin.master.promo.content') }}"class="btn btn-secondary"
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
