<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;

class FrontCatalogController extends Controller
{
    public function index(Request $request)
    {
        $attributes = Attribute::all();

        $attributes_filters = Attribute::all();
        $attributes_filters = $attributes_filters->pluck('code');

        $products = Product::with('attributes');

        /*if($request->has(['minPrice', 'maxPrice']))  {
            $products->where('price', '>=', $request->minPrice);
            $products->where('price', '<=', $request->maxPrice);
        }*/

        foreach($attributes_filters as $attribute) {
            if($request->has($attribute)) {
                $products->whereHas('attributes', function($query) use($request, $attribute) {
                    $query->where('code', $attribute);
                    $query->where('value');
                    foreach($request->$attribute as $attr) {
                        $query->orWhere('value', $attr);
                    }
                });
            }
        }

        $products = $products->get();

        //dd($attributes);
        return view('frontend.catalog.index', compact('products', 'attributes'));
    }
}
