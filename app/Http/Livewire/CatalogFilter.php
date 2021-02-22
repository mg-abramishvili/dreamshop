<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;

use Livewire\Component;

class CatalogFilter extends Component
{
    public $minPrice = 0;
    public $maxPrice = 9999900;

    public $diagonal = [];
    public $disk = [];

    public function render()
    {
        $minPrice = $this->minPrice;
        $maxPrice = $this->maxPrice;

        $diagonal = $this->diagonal;
        $disk = $this->disk;

        $attributes = Attribute::with('products')->get();

        $products = Product::with('attributes')
        ->whereHas('attributes', function($query) use($diagonal, $disk) {
                $query->where('code');
                foreach ($diagonal as $diagonal_value) {
                    $query->orWhere('value', $diagonal_value);
                }
                foreach ($disk as $disk_value) {
                    $query->orWhere('value', $disk_value);
                }
        })
        ->whereBetween('price', array($minPrice,$maxPrice))
        ->get();
        
        //dd($diagonal);

        return view('livewire.catalog-filter', [
            'products' => $products,
            'attributes' => $attributes,
            'diagonal' => $diagonal,
            'disk' => $disk,
        ]);
    }
}
