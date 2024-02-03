@section('app.title', 'Promo Content - Edit')
@section('content.header.title', 'Promo Content - Edit')

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
            <h4 class="card-title"> Edit Data </h4>
        </div>
        <div class="card-body">
            <div class="form-body">
                <form wire:submit="save" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text"
                                    class="form-control @error('category_name')  {{ $classState }} @enderror"
                                    name="category_name" placeholder="Category Name" wire:model="category_name"
                                    value="{{ $category_name }}" readonly disabled>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="content_image">Image</label>
                                        <input type="file"
                                            class="form-control @error('content_image') {{ $classState }} @enderror"
                                            name="content_image" placeholder="Image" accept="image/png"
                                            wire:model="content_image">
                                        <span><small class="text-muted">Image format png.</small></span>

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

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="content_image">Current Images</label>
                                        @foreach ($list_content_image as $val)
                                            <div class="box">
                                                <button type="button" class="btn btn-danger btn-sm rounded-pill icon"
                                                    onclick="popDelete({{ $val['id'] }})" title="Delete"><i
                                                        class="bi bi-x"></i></button>
                                                <div style="width: 325px;">
                                                    <img class="img-fluid" src="{{ $val['image'] }}"
                                                        wire:key="{{ $val['id'] }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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

            document.addEventListener('livewire:initialized', () => {
                @this.on('showResult', (response) => popResult2(response));
            });

            document.addEventListener('livewire:navigated', () => {
                // console.log('livewire load code when navigated');
                Livewire.on('showResult', (response) => popResult2(response));
            });
        </script>

    @endsection
