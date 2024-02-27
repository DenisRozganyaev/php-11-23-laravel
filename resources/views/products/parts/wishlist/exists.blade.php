@if (!$product->isExists && !$isFollowed)
    <form action="{{route('wishlist.add', $product)}}" method="post" class="@if($minimized) w-50 @else w-100 @endif">
        @csrf
        <input type="hidden" name="type" value="exist">
        <div class="mb-3 row w-100">
            @unless($minimized)
                <label for="staticEmail" class="col-sm-9 col-form-label">Notify when exists</label>
            @endunless
            <div class="col-sm-3">
                <button type="submit" class="btn btn-outline-warning"><i class="fa-regular fa-envelope"></i></button>
            </div>
        </div>
    </form>
@endif

@if($isFollowed)
    <form action="{{route('wishlist.remove', $product)}}" method="post" class="@if($minimized) w-50 @else w-100 @endif">
        @csrf
        @method('delete')
        <input type="hidden" name="type" value="exist">
        <div class="mb-3 row w-100">
            @unless($minimized)
                <label for="staticEmail" class="col-sm-9 col-form-label">Unsubscribe from exists event</label>
            @endunless
            <div class="col-sm-3">
                <button type="submit" class="btn btn-outline-danger"><i class="fa-regular fa-envelope"></i></button>
            </div>
        </div>
    </form>
@endif
