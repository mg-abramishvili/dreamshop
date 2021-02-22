<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Value;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->get();
        return view('backend.catalog.index', compact('categories'));
    }

    public function show_category($id)
    {
        $category = Category::find($id);
        $categories = Category::with('children')->get();
        $products = Product::with('categories')->whereHas('categories', function($query) use($id) {
            $query->where('category_id', $id);
        })->get();
        return view('backend.catalog.show_category', compact('category', 'categories', 'products'));
    }

    public function create_category($current_category, Request $request)
    {
        $categories = Category::all();
        $current_category = $current_category;
        return view('backend.catalog.create_category', compact('categories', 'current_category'));
    }

    public function store_category(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $data = request()->all();
        $categories = new Category();
        $categories->title = $data['title'];
        $categories->parent_id = $data['parent_id'];
        $categories->save();
        return redirect('/backend/catalog/category/'.$categories->parent_id);
    }

    public function create_product($current_category, Request $request)
    {
        $categories = Category::all();
        $current_category = $current_category;
        $attributes = Attribute::with('categories')->whereHas('categories', function($query) use($current_category) {
            $query->where('category_id', $current_category);
        })->get();

        return view('backend.catalog.create_product', compact('categories', 'attributes', 'current_category'));
    }

    public function store_product(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required|numeric',
        ]);

        $data = request()->all();
        $products = new Product();
        $products->title = $data['title'];
        $products->price = $data['price'];
        $products->save();
        $products->categories()->attach($request->categories, ['product_id' => $products->id]);
        $products->attributes()->sync($this->mapAttributes($data['attributes']));
        //$attributes = $request->attribute;
        //$values = $request->value;

        //foreach ($attributes as $key => $attribute_value) {
        //    $products->attributes()->attach($attribute_value, ['product_id' => $products->id]);
        //}

        $attributes = Attribute::with('categories')->whereHas('categories', function($query) {
            $query->where('category_id');
        })->get()->pluck('id');

        foreach ($attributes as $key => $attribute) {
            dd($attribute);
            //$products->attributes()->attach($attribute_value, ['product_id' => $products->id]);
        }
        
        return redirect('/backend/catalog/category/'.$request->current_category);
    }

    public function edit_product($id, Request $request)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $attributes = Attribute::with('categories')->whereHas('categories', function($query) {
            //$query->where('category_id');
        })->get();

        return view('backend.catalog.edit_product', compact('product', 'categories', 'attributes'));
    }

    public function add_attribute(Request $request)
    {
        $data = request()->all();
        $product = Product::find($data['product_id']);
        $attribute = Attribute::find($data['attribute_id']);
        $product->attributes()->attach($attribute, ['product_id' => $product->id]);
        $value = new Value([
            'value' => $data['value'],
        ]);
        $attribute->values()->save($value);
    }

    private function mapAttributes($attributes)
    {
        return collect($attributes)->map(function ($i) {
            return [
                'value' => $i,
                'value_id' => \Str::random(10)
            ];
        });
    }
}
