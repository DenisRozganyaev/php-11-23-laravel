<form action="{{route('wishlist.add', $product)}}" method="post" class="w-100">
    @csrf
    <input type="hidden" name="type" value="price">
    <div class="mb-3 row w-100">
        <label for="staticEmail" class="col-sm-9 col-form-label">Notify when price will be lower</label>
        <div class="col-sm-3">
            <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-chart-line"></i></button>
        </div>
    </div>
</form>
