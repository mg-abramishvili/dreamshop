@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <h1 calss="mt-0 mb-0">Категории</h1>
        </div>
        <div class="col-12 col-md-6 text-right">
            <a href="/backend/categories/new" class="btn btn-primary">Добавить категорию</a>
        </div>
    </div>
    

    <ul class="categories-list">
        @foreach($categories as $category)
            @if(isset($category->parent_id))
            @else
                <li>
                    <strong><a href="/backend/category/{{{ $category->id }}}/">{{{ $category->title }}}</a></strong>
                    @if(count($category->children))
                        @include('backend.categories.sub ', ['children' => $category->children])
                    @endif
                </li>
            @endif
        @endforeach
    </ul>

@endsection