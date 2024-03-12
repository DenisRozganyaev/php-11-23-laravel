<form action="{{route('cart.add', $product)}}" method="post" class="w-100 btn-group product-preview-button-container">
    @csrf
    <a href="{{route('products.show', $product)}}" class="btn btn-outline-secondary">Show</a>
    <button type="submit" class="btn btn-outline-success">Buy</button>
</form>
