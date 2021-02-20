<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontCatalogController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('frontend.catalog.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('details');

        $details = Detail::get()->map(function($detail) use ($product) {
            $detail->value = data_get($product->details->firstWhere('id', $detail->id), 'pivot.value') ?? null;
            return $detail;
        });
    
        return view('backend.products.edit', [
            'details' => $details,
            'product' => $product,
        ]);
    }
}
