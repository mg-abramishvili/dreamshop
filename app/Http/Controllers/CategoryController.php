<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->get();
        return view('backend.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::find($id);
        $products = Product::with('categories')->whereHas('categories', function($query) use($id) {
            $query->where('category_id', $id);
        })->get();
        return view('backend.categories.show', compact('category', 'products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.categories.create', compact('categories'));
    }

    public function edit($id)
    {
        $category = categories::find($id);
        return view('backend.categories.edit', compact('category'));
    }

    public function file($type)
    {
        switch ($type) {
            case 'upload':
                return $this->upload();
        }

        return \Response::make('success', 200, [
            'Content-Disposition' => 'inline',
        ]);
    }

    public function upload()
    {

        if (request()->file('color_image')) {
            $file = request()->file('color_image');

            $filename = md5(time() . rand(1, 100000)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads', $filename);

            return \Response::make('/uploads/' . $filename, 200, [
                'Content-Disposition' => 'inline',
            ]);
        }

    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/backend/categories');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $data = request()->all();
        $categories = new Category();
        $categories->title = $data['title'];
        $categories->parent_id = $data['parent_id'];
        $categories->save();
        return redirect('/backend/categories');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'base_price' => 'required',
            'construct_type' => 'required',
            'manufacturer' => 'required',
            'surface' => 'required',
            'style' => 'required',
        ]);

        $data = request()->all();
        $products = Product::find($data['id']);
        $products->title = $data['title'];
        $products->base_price = $data['base_price'];

        if (!empty($data['description'])) {
            $products->description = $data['description'];
        }

        $products->construct_type = $data['construct_type'];
        $products->manufacturer = $data['manufacturer'];
        $products->surface = $data['surface'];
        $products->style = $data['style'];
        $products->save();
        return redirect('/backend/products');
    }
}
