<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Value;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return view('backend.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('backend.attributes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'filter' => 'required',
        ]);

        $data = request()->all();
        $attributes = new Attribute();
        $attributes->code = $data['code'];
        $attributes->name = $data['name'];
        $attributes->filter = $data['filter'];
        $attributes->save();
        return redirect('/backend/attributes');
    }

    public function addValue(Request $request) {
        $data = request()->all();
        $attributes = Attribute::find($data['id']);
        $value = new Value([
            'value' => $data['value'],
        ]);
        $attributes->values()->save($value);
        return back();
    }

    public function edit($id, Request $request)
    {
        $attribute = Attribute::find($id);
        return view('backend.attributes.edit', compact('attribute'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $data = request()->all();
        $attributes = Attribute::find($data['id']);
        $attributes->name = $data['name'];
        $attributes->save();
        return redirect('/backend/attributes');
    }
}
