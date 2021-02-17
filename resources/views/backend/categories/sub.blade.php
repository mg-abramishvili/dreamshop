<ul class="categories-list categories-list-sublist">
    @foreach($children as $child)
        <li>
            <a href="/backend/category/{{ $child->id }}">{{{ $child->title }}}</a>
            @if(count($child->children))
                @include('backend.categories.sub ',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>