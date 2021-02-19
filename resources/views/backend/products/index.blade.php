@extends('layouts.app')
@section('content')

    @foreach($details as $detail)
        <h5>{{ $detail->title }}</h5>

        @foreach($detail->products as $product)
            {{ $product->pivot->value }}
        @endforeach
    @endforeach
    <hr>

    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <h1 calss="mt-0 mb-0">Товары</h1>
        </div>
        <div class="col-12 col-md-6 text-right">
            <a href="/backend/products/new" class="btn btn-primary">Добавить товар</a>
        </div>
    </div>    

    <table class="table table-bordered table-hover">
        @foreach($products as $product)
            <tr>
                <td style="width:80%;">
                    {{ $product->title }}
                </td>
                <td class="text-center">
                    <a href="/backend/product/{{{ $product->id }}}/">Правка</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection