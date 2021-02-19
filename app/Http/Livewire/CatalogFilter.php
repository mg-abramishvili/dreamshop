<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Detail;

use Livewire\Component;

class CatalogFilter extends Component
{
    public $diagonal_filter;
    public $ssd_filter;

    public function render()
    {
        $diagonal_filter = $this->diagonal_filter;
        $ssd_filter = $this->ssd_filter;

        $filters = Detail::where('filter', 'y')->pluck('code');

        $details = Detail::where(function($query) use ($filters) {
            $query->where('code');
            foreach ($filters as $filter) {
                $query->orWhere('code', $filter);
            }
        })->get();

        $products = Product::with('details')
        ->whereHas('details', function($query) use ($filters, $diagonal_filter, $ssd_filter) {
                $query->where('code', 'diagonal');
                $query->where('value', '42"');
        })
        ->whereHas('details', function($query) use ($filters, $diagonal_filter, $ssd_filter) {
            $query->where('code', 'ssd');
            $query->where('value', '256Gb');
        })
        ->get();

        return view('livewire.catalog-filter', [
            'products' => $products,
            'details' => $details,
        ]);
    }
}
