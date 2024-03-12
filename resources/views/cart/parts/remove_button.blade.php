<form action="{{route('cart.remove', $product)}}" method="post" class="w-25">
    @csrf
    @method('delete')
    <input type="hidden" name="rowId" value="{{$rowId}}">
    <button type="submit" class="btn btn-outline-danger w-100">Remove</button>
</form>
