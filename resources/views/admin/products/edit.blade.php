@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Product') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.products.update', $product) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ $product->title ?? old('title') }}" required autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="SKU" class="col-md-4 col-form-label text-md-end">{{ __('SKU') }}</label>

                                <div class="col-md-6">
                                    <input id="SKU" type="text" class="form-control @error('SKU') is-invalid @enderror"
                                           name="SKU" value="{{ $product->SKU ?? old('SKU') }}" required>

                                    @error('SKU')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="categories"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Categories') }}</label>

                                <div class="col-md-6">
                                    <select name="categories[]" id="categories" class="form-control" multiple>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}"
                                                @if(in_array($category->id, $productCategories)) selected @endif
                                            >{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" name="description"
                                              class="form-control @error('description') is-invalid @enderror">{{ $product->description ?? old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <input id="price" type="text"
                                           class="form-control @error('price') is-invalid @enderror" name="price"
                                           value="{{ $product->price ?? old('price') }}" required>

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="new_price"
                                       class="col-md-4 col-form-label text-md-end">{{ __('New Price') }}</label>

                                <div class="col-md-6">
                                    <input id="new_price" type="text"
                                           class="form-control @error('new_price') is-invalid @enderror"
                                           name="new_price" value="{{ $product->new_price ?? old('new_price') }}">

                                    @error('new_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="quantity"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>

                                <div class="col-md-6">
                                    <input id="quantity" type="number" min="0"
                                           class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                           value="{{ $product->quantity ?? old('quantity') }}" required>

                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="thumbnail"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Thumbnail') }}</label>

                                <div class="col-md-12 mb-4 d-flex align-items-center justify-content-center">
                                    <img src="{{ $product->thumbnailUrl }}" id="thumbnail-preview" style="width: 50%">
                                </div>
                                <div class="col-md-12">
                                    <input id="thumbnail" type="file"
                                           class="form-control @error('thumbnail') is-invalid @enderror"
                                           name="thumbnail"
                                    >

                                    @error('thumbnail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="images"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Images') }}</label>

                                <div class="row">
                                    <div class="col-md-12 images-wrapper">
                                        @foreach($product->images as $image)
                                            <div class="mb-4 row flex-row align-items-center images-wrapper-item">
                                                <div class="col-10 d-flex align-items-center justify-content-center">
                                                    <img src="{{ $image->url }}" style="max-width: 100%; max-height: 350px;" />
                                                </div>
                                                <div class="col-2">
                                                    <button
                                                        class="btn btn-danger image-remove"
                                                        data-url="{{route('ajax.images.destroy', $image)}}"
                                                    ><i class="fa-solid fa-trash-can"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-4 row flex-row align-items-center images-wrapper-item">
                                            <div class="col-10 d-flex align-items-center justify-content-center">
                                                <input type="file" class="d-none image-input-add" />
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-success image-add" data-url="{{route('ajax.products.images.store', $product)}}">
                                                    Upload <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-js')
    @vite(['resources/js/admin/images-preview.js', 'resources/js/admin/images-actions.js'])
@endpush
