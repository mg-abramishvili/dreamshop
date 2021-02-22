@extends('layouts.app')
@section('content')

        <div class="row align-items-center mb-4">
            <div class="col-12">
                <h1>{{ $product->title }}</h1>
            </div>
        </div>

        <form action="/backend/catalog-products" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <input type="hidden" name="id" value="{{$product->id}}">
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Название</label>
                        <input type="text" class="form-control" name="title" placeholder="Название" value="{{ $product->title }}">
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
                        <input type="text" class="form-control" name="price" placeholder="Цена" value="{{ $product->price }}">
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
                            <option value="{{ $category->id }}" @foreach($product->categories as $cat) @if($category->id == $cat->id) selected @endif @endforeach>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <button type="submit" class="btn btn-lg btn-success">Сохранить</button>
        </form>

                <div>
                    @foreach($attributes as $attribute)
                        <form action="{{ route('product.attribute.new', $attribute->id) }}" method="post" enctype="multipart/form-data">@csrf
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-5 text-right">
                                    <label class="m-0">{{ $attribute->name }}</label>
                                </div>
                                <div class="col-12 col-lg-5">
                                    <input name="product_id" type="hidden" class="form-control" value="{{ $product->id }}">
                                    <input name="attribute_id" type="text" class="form-control" value="{{ $attribute->id }}">
                                    <input name="value" type="text" class="form-control">
                                </div>
                                <div class="col-12 col-lg-2">
                                    <input type="submit" value="OK">
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>

            




@endsection