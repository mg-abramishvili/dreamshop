@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <h1 calss="mt-0 mb-0">Каталог</h1>
        </div>
        <div class="col-12 col-md-6 text-right">
            <a href="/backend/catalog/new-product/{{ $category->id }}" class="btn btn-primary">Добавить товар</a>
            <a href="/backend/catalog/new-category/{{ $category->id }}" class="btn btn-primary">Добавить категорию</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-3">
            <ul class="categories-list">
                @foreach($categories as $category)
                    @if(isset($category->parent_id))
                    @else
                        <li>
                            <strong><a href="/backend/catalog/category/{{{ $category->id }}}/">{{{ $category->title }}}</a></strong>
                            @if(count($category->children))
                                @include('backend.catalog.sub ', ['children' => $category->children])
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-12 col-lg-9">
            <table class="table table-bordered table-hover">
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>Пусто :(</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>

@endsection