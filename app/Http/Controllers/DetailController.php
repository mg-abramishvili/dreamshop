<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Value;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index()
    {
        $details = Detail::all();
        return view('backend.details.index', compact('details'));
    }

    public function create()
    {
        return view('backend.details.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'title' => 'required',
            'filter' => 'required',
        ]);

        $data = request()->all();
        $details = new Detail();
        $details->code = $data['code'];
        $details->title = $data['title'];
        $details->filter = $data['filter'];
        $details->save();
        return redirect('/backend/details');
    }

    public function addValue(Request $request) {
        $data = request()->all();
        $details = Detail::find($data['id']);
        $value = new Value([
            'value' => $data['value'],
        ]);
        $details->values()->save($value);
        return back();
    }

    public function show(Detail $detail)
    {
        //
    }

    public function edit($id, Request $request)
    {
        $detail = Detail::find($id);
        return view('backend.details.edit', compact('detail'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $data = request()->all();
        $details = Detail::find($data['id']);
        $details->title = $data['title'];
        $details->save();
        return redirect('/backend/details');
    }

    public function destroy(Detail $detail)
    {
        //
    }
}
