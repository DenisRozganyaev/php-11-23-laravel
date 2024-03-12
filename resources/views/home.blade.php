@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-6 mb-5">
                @foreach($categories as $category)
                    <div class="col d-flex align-items-center">
                        @include('categories.parts.button', ['category' => $category, 'classes' => 'w-100'])
                    </div>
                @endforeach
            </div>
            <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 g-4">
                @each('products.parts.card', $products, 'product')
            </div>
        </div>
    </div>
@endsection
