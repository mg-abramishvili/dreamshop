<ul class="categories-list categories-list-sublist">
    @foreach($children as $child)
        <li>
            <a href="/backend/catalog/category/{{ $child->id }}">{{{ $child->title }}}</a>
            @if(count($child->children))
                @include('backend.catalog.sub ',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>