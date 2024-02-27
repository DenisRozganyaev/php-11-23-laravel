@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h3>Your wish list</h3>
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">@sortablelink('id', '#')</th>
                        <th scope="col">Image</th>
                        <th scope="col">@sortablelink('title', 'Title')</th>
                        <th scope="col">@sortablelink('price', 'price')</th>
                        <th scope="col" class="text-center">Follow Price</th>
                        <th scope="col" class="text-center">Follow Exists</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><img src="{{$product->thumbnailUrl}}" alt="{{$product->title}}" width="25" height="50"></td>
                            <td>
                                <a href="{{route('products.show', $product)}}">{{$product->title}}</a>
                            </td>
                            <td>{{$product->finalPrice}}</td>
                            <td class="text-center" style="font-size: 18px"><i class="fa-solid fa-{{$product->pivot->price ? 'check' : 'xmark'}}"></i></td>
                            <td class="text-center" style="font-size: 18px"><i class="fa-solid fa-{{$product->pivot->exist ? 'check' : 'xmark'}}"></i></td>
                            <td>
                                <div class="d-flex justify-content-end w-100 align-items-center">
                                    @include(
                                        'products.parts.wishlist.price',
                                        [
                                            'product' => $product,
                                            'isFollowed' => auth()->user()->isWishedProduct($product),
                                            'minimized' => true
                                        ]
                                    )
                                    @include(
                                        'products.parts.wishlist.exists',
                                        [
                                            'product' => $product,
                                            'isFollowed' => auth()->user()->isWishedProduct($product, 'exist'),
                                            'minimized' => true
                                        ]
                                    )
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$products->links()}}
            </div>
        </div>
    </div>
@endsection
