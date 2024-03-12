@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-sm-2 g-2 mb-5">
            <div class="col col-sm-4">
                {{--                <img src="{{$product->thumbnailUrl}}" alt="{{$product->title}}" class="w-100"/>--}}
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                        @foreach($gallery as $key => $image)
                            <button type="button"
                                    data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{$key}}"
                                    class="{{$key === 0 ? 'active' : ''}}"
                                    aria-current="true"
                                    aria-label="Slide {{$key + 1}}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($gallery as $key => $image)
                            <div class="carousel-item {{$key === 0 ? 'active' : ''}}">
                                <img src="{{$image}}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col col-sm-8">
                <div class="d-flex flex-column align-items-start justify-content-start ms-5">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <h4 class="mb-5">{{$product->title}}</h4>
                        <small class="mb-2">SKU: {{ $product->SKU }}</small>
                    </div>
                    <div class="d-flex flex-column justify-content-start w-100 align-items-start mb-3">
                        <p>Categories:</p>
                        <div>
                            @each('categories.parts.button', $product->categories, 'category')
                        </div>
                    </div>
                    <p class="mb-2">Quantity: {{ $product->quantity }}</p>
                    <div class="d-flex justify-content-end w-100 align-items-center">
                        @if (!auth()->user()->isWishedProduct($product))
                            @include('products.parts.wishlist.price', ['product' => $product])
                        @else

                        @endif
                        @if (!auth()->user()->isWishedProduct($product, 'exist'))
                            @include('products.parts.wishlist.exists', ['product' => $product])
                        @else

                        @endif
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center price-container">
                        <h5 class="me-2 mb-0">{{$product->price}}$</h5>
                        @if($product->isExists)
                            @if($isInCart)
                                @include('cart.parts.remove_button', ['product' => $product, 'rowId' => $rowId])
                            @else
                                @include('cart.parts.add_button', ['product' => $product])
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 text-center fs-5 mt-3">
                <p>{{$product->description}}</p>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
@endsection
