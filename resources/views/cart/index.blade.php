@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row g-2 mb-5 text-center">
            <h3>Cart</h3>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 g-2 mb-5">
            <div class="col-12 col-sm-8 col-md-9">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="text-align: center">Image</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($content as $row)
                        <tr>
                            <td style="max-width: 100px; text-align: center">
                                <a href="{{route('products.show', $row->id)}}">
                                    <img src="{{$row->model->thumbnailUrl}}" style="height: 75px;" alt="{{$row->name}}">
                                </a>
                            </td>
                            <td>
                                <a href="{{route('products.show', $row->id)}}">
                                    {{$row->name}}
                                </a>
                            </td>
                            <td>
                                <form action="{{route('cart.count.update', $row->model)}}" style="max-width: 200px;" method="POST">
                                    @csrf
                                    <input type="hidden" name="rowId" value="{{$row->rowId}}" />
                                    <input type="number" name="count" class="form-control counter" value="{{$row->qty}}"
                                           max="{{$row->model->quantity}}" min="1" />
                                </form>
                            </td>
                            <td>${{$row->price}}</td>
                            <td>${{$row->subtotal}}</td>
                            <td>
                                <form action="{{route('cart.remove')}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="rowId" value="{{$row->rowId}}" />
                                    <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-12 col-sm-4 col-md-3">
                <table class="table table-striped-columns">
                    <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td>${{ $subTotal }}</td>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <td>${{ $tax }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>${{ $total }}</td>
                    </tr>
                    </tbody>
                </table>
                <hr>
                @auth()
                    <a href="{{route('checkout')}}" class="btn btn-outline-success w-100">Proceed to checkout</a>
                @else
                    <a href="{{route('login')}}" class="btn btn-outline-info w-100 mb-3">Sign In</a>
                    <a href="{{route('register')}}" class="btn btn-outline-warning w-100">Sign up</a>
                @endauth
            </div>
        </div>
    </div>
@endsection

@push('footer-js')
    @vite(['resources/js/cart.js'])
@endpush
