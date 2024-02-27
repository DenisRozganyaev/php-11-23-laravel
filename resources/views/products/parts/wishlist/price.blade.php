@unless($isFollowed)
    <form action="{{route('wishlist.add', $product)}}" method="post" class="@if($minimized) w-50 @else w-100 @endif">
        @csrf
        <input type="hidden" name="type" value="price">
        <div class="mb-3 row w-100">
            @unless($minimized)
                <label for="staticEmail" class="col-sm-9 col-form-label">Notify when price will be lower</label>
            @endunless
            <div class="col-sm-3">
                <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-chart-line"></i></button>
            </div>
        </div>
    </form>
@else
    <form action="{{route('wishlist.remove', $product)}}" method="post" class="@if($minimized) w-50 @else w-100 @endif">
        @csrf
        @method('delete')
        <input type="hidden" name="type" value="price">
        <div class="mb-3 row w-100">
            @unless($minimized)
                <label for="staticEmail" class="col-sm-9 col-form-label">Product price unsubscribe</label>
            @endunless
            <div class="col-sm-3">
                <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-chart-line"></i></button>
            </div>
        </div>
    </form>
@endunless
