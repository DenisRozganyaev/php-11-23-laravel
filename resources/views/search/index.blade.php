@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 g-4">
                @each('products.parts.card', $products, 'product')
            </div>
            <div class="row">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
