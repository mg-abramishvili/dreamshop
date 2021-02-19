<div class="row">
    <div class="col-12 col-lg-3">
        @foreach($details as $detail)
            <h5>{{ $detail->title }}</h5>

            @foreach($detail->products as $product)
                <label>
                    <input wire:model="{{ $detail->code }}_filter" type="checkbox" value="{{ $product->pivot->value }}">
                    {{ $product->pivot->value }}
                </label>
            @endforeach
        @endforeach
    </div>

    <div class="col-12 col-lg-9">
        <div class="row">
            @foreach($products as $product)
                <div class="col-12 col-lg-3">
                    <div class="catalog-item">
                        <a href="#">
                            {{ $product->title }}

                            @foreach($product->details as $detail)
                                {{$detail->title}} - 
                                {{$detail->pivot->value}}
                            @endforeach
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>