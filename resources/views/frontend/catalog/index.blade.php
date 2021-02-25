@extends('layouts.front')
@section('content')

<div class="row">
    <div class="col-12 col-lg-3">
        <aside>
            @foreach($attributes as $attribute)
                <div class="form-group mb-4">
                    <span class="font-weight-bold">{{ $attribute->name }}</span>

                    @foreach($attribute->products->unique('pivot.value') as $attr)
                        <div class="form-group mb-0">
                            <label for="{{ $attr->pivot->value_id }}">
                                <input type="checkbox" name="{{ $attribute->code }}" id="{{ $attr->pivot->value_id }}" value="{{ $attr->pivot->value }}" @foreach(explode('|', request()->get($attribute->code)) as $ac) @if($ac == $attr->pivot->value) checked @endif @endforeach>
                                {{ $attr->pivot->value }}
                            </label>
                        </div>
                    @endforeach
                    
                </div>
            @endforeach

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
                    
                    <script>
                        var test = "";

                        $(':checkbox[name={{ $attribute->code }}]').change(function() {
                            test = "";
                            $(':checkbox[name={{ $attribute->code }}]:checked').each(function() {
                                if(test == '') {
                                    test = $(this).val();
                                } else {
                                    test = test + '|' + $(this).val();
                                }
                            });

                            if(test == '') {
                                test_f = ''
                            } else {
                                test_f = test;
                            }
                            
                            $('#{{ $attribute->code }}').remove();

                            $("<input>").attr({ 
                                name: "{{ $attribute->code }}", 
                                id: "{{ $attribute->code }}", 
                                type: "hidden", 
                                value: test_f 
                            }).appendTo("form");
                        });
                    </script>
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
                                        <span>{{ $attribute->pivot->value }}</span><br>
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