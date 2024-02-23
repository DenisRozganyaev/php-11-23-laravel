@if (!$product->isExists)
    <form action="{{route('wishlist.add', $product)}}" method="post" class="w-100">
        @csrf
        <input type="hidden" name="type" value="exist">
        <div class="mb-3 row w-100">
            <label for="staticEmail" class="col-sm-9 col-form-label">Notify when exists</label>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-outline-warning"><i class="fa-regular fa-envelope"></i></button>
            </div>
        </div>
    </form>
@endif
