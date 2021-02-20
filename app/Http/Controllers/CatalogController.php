<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
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
        $attributes = Attribute::with('categories')->whereHas('categories')->get();

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
        return redirect('/backend/catalog/category/'.$request->current_category);
    }
}
