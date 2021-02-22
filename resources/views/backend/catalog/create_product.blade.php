@extends('layouts.app')
@section('content')

    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12">
                <h1>Новый товар</h1>
            </div>
        </div>

        <form action="/backend/catalog-products" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Название</label>
                        <input type="text" class="form-control" name="title" placeholder="Название">
                        @if ($errors->has('title'))
                            <div class="alert alert-danger">
                                Укажите название
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="price" class="font-weight-bold">Цена</label>
                        <input type="text" class="form-control" name="price" placeholder="Цена">
                        @if($errors->has('price'))
                            <div class="alert alert-danger">
                                Укажите цену
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <select name="categories[]" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $current_category) selected @endif>{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="current_category" value="{{ $current_category }}">
                </div>

            </div>

            @foreach($attributes as $attribute)
                <input name="attributes[{{ $attribute->id }}]" type="text" class="form-control" placeholder="{{ $attribute->name }}">
            @endforeach

            <button type="submit" class="btn btn-lg btn-success">Сохранить</button>
        </form>
    </div>

@endsection