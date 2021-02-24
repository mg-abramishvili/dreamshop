@extends('layouts.front')
@section('content')

<div class="row">
    <div class="col-12 col-lg-3">
        <aside>
            <form action="/catalog">
                <!--<div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" name="minPrice" placeholder="от" class="form-control" value="{{ request()->minPrice }}">
                        </div>
                        <div class="col-6">
                            <input type="text" name="maxPrice" placeholder="до" class="form-control" value="{{ request()->maxPrice }}">
                        </div>
                    </div>
                </div>-->
                @foreach($attributes as $attribute)
                    <div class="form-group mb-4">
                        {{ $attribute->name }}

                        @foreach($attribute->products as $attr)
                            <div class="form-group mb-0">
                                <label for="{{ $attr->pivot->value_id }}">
                                    <input type="checkbox" name="{{ $attribute->code }}[]" id="{{ $attr->pivot->value_id }}" value="{{ $attr->pivot->value }}">
                                    {{ $attr->pivot->value }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Применить</button>
            </form>
        </aside>
    </div>

    <div class="col-12 col-lg-9">
        <div class="row">

            @forelse($products as $product)
                <div class="col-12 col-lg-3">
                    <div class="catalog-item">
                        <a href="#">
                            {{ $product->title }}
                            <h6><strong>{{$product->price}}</strong></h6>

                            @if($product->attributes)
                                @foreach($product->attributes as $attribute)
                                    {{ $attribute->name }}

                                    @if($attribute->pivot)
                                        {{ $attribute->pivot->value_id }}
                                        {{ $attribute->pivot->value }}
                                    @endif
                                @endforeach
                            @endif
                        </a>
                    </div>
                </div>
            @empty
                <p>Ничего не найдено :(</p>
            @endforelse
        </div>
    </div>
</div>

@endsection