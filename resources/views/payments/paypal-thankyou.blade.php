@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h3>The order was completed, thank you!</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4 class="mb-3">User Info:</h4>
                    <table class="table table-striped-columns">
                        <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <td>Surname</td>
                            <td>{{ $order->surname }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $order->email }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $order->phone }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ $order->city }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $order->address }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-md-6">
                    <h4 class="mb-3">Order Info:</h4>
                    <table class="table table-striped-columns">
                        <tbody>
                        <tr>
                            <td>Total</td>
                            <td>{{ $order->total }}</td>
                        </tr>
                        <tr>
                            <td>VAT</td>
                            <td>5%</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $order->status->name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <h4 class="mb-3">Products Info:</h4>
                    <table class="table table-striped-columns">
                        <thead>
                        <tr>
                            <td>Image</td>
                            <td>Name</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Total</td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td>
                                        <a href="{{route('products.show', $product)}}">
                                            <img src="{{$product->thumbnailUrl}}" style="height: 75px;" alt="{{$product->title}}">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('products.show', $product)}}">
                                            {{$product->title}}
                                        </a>
                                    </td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ $product->pivot->single_price }}</td>
                                    <td>{{ $product->pivot->quantity * $product->pivot->single_price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-5 text-center">
                    <a class="btn btn-primary" href="{{route('invoice', $order)}}" target="_blank">Get invoice file</a>
                </div>
            </div>
        </div>
    </div>
@endsection
