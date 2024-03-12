<form action="{{route('cart.add', $product)}}" method="post" class="w-25">
    @csrf
    <button type="submit" class="btn btn-outline-success w-100">Buy</button>
</form>
