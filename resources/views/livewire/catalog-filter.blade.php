<div class="row">
    <div class="col-12 col-lg-3">
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    {{ $minPrice }}
                    <input type="number" min="0" step="100" wire:model.debounce.500ms="minPrice" placeholder="от" class="form-control">
                </div>
                <div class="col-6">
                    {{ $maxPrice }}
                    <input type="number" max="9999900" step="100" wire:model.debounce.500ms="maxPrice" placeholder="до" class="form-control">
                </div>
            </div>
        </div>

        @foreach($attributes as $attribute)
            <div class="form-group mb-4">
                {{ $attribute->name }}

                @foreach($attribute->products as $attr)
                    <div class="form-group mb-0">
                        <label for="{{ $attr->pivot->value_id }}">
                            <input type="checkbox" wire:model.debounce.500ms="{{ $attribute->code }}" id="{{ $attr->pivot->value_id }}" value="{{ $attr->pivot->value }}" checked>
                            {{ $attr->pivot->value }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach
       
    </div>

    <div class="col-12 col-lg-9">
        <div class="row">
            
            <div class="col-12">
                <div wire:loading.delay>
                    Загрузка...
                </div>
            </div>

            @foreach($products as $product)
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
            @endforeach
        </div>
    </div>
</div>