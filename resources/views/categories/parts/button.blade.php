<a href="{{route('categories.show', $category)}}"
   class="btn btn-outline-dark {{ (!empty($classes) ? $classes : '')}}"
>{{$category->name}}</a>
