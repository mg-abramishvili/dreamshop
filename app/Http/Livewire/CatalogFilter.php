<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;

use Livewire\Component;

class CatalogFilter extends Component
{
    public $minPrice = 0;
    public $maxPrice = 9999900;

    public function render()
    {
        $minPrice = $this->minPrice;
        $maxPrice = $this->maxPrice;

        $products = Product
        /*->whereHas('details', function($query) use ($filters, $diagonals, $ssds) {
                $query->where('code', 'diagonal');
                $query->where('value', '32"');
                $query->orwhere('value', '42"');
        })
        ->whereHas('details', function($query) use ($filters, $diagonals, $ssds) {
            $query->where('code', 'ssd');
            $query->where('value', '128Gb');
            $query->orwhere('value', '256Gb');
        })*/
        ::whereBetween('price',array($minPrice,$maxPrice))
        ->get();

        return view('livewire.catalog-filter', [
            'products' => $products,
        ]);
    }
}
