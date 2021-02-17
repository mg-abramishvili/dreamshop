@extends('layouts.app')
@section('content')

    @foreach($products as $product)
        {{ $product->title }}
    @endforeach

@endsection