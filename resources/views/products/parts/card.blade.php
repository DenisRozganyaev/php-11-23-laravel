<div class="col">
    <div class="card shadow-sm">
        <div class="bd-placeholder-img card-img-top product-preview-image" style="background-image: url('{{$product->thumbnailUrl}}')"></div>
        <div class="card-body">
            <h5 class="card-title">{{ $product->title }}</h5>
            @if ($product->discount)
                <small class="text-body-secondary product-preview-price">Discount: <span style="color: #9a1414;">{{ $product->discount }}%</span></small>
            @endif
            <p class="text-body-secondary product-preview-price">{{ $product->finalPrice }} $</p>
            <div class="d-flex justify-content-between align-items-center">
{{--                <div class="btn-group product-preview-button-container">--}}
{{--                    <a href="{{route('products.show', $product)}}" class="btn btn-sm btn-outline-secondary">Show</a>--}}
{{--                    <a class="btn btn-sm btn-outline-success">Buy</a>--}}
{{--                </div>--}}
                @include('products.parts.card_buttons', ['product' => $product])
            </div>
        </div>
    </div>
</div>
