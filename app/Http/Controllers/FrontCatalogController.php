<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Detail;
use Illuminate\Http\Request;

class FrontCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = Detail::where('filter', 'y')->pluck('code');

        $details = Detail::where(function($query) use ($filters) {
            $query->where('code');
            foreach ($filters as $filter) {
                $query->orWhere('code', $filter);
            }
        })->get();

        $products = Product::with('details')->whereHas('details', function($query) use ($filters) {
            foreach ($filters as $filter) {
                $query->where('code', 'ssd');
                $query->where('value', '128Gb');
            }
        })->get();

        //dd($filters);
        return view('frontend.catalog.index', compact('products', 'details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.create', [
            'categories' => Category::all(),
            'details' => Detail::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
        ]);

        $data = request()->all();
        $products = new Product();
        $products->title = $data['title'];
        $products->price = $data['price'];
        $products->save();
        $products->categories()->attach($request->categories, ['product_id' => $products->id]);
        $products->details()->sync($this->mapDetails($data['details']));
        return redirect('/backend/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    private function mapDetails($details)
{
    return collect($details)->map(function ($i) {
        return ['value' => $i];
    });
}
}
