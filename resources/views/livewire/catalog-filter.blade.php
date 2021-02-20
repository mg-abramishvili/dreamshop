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
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>