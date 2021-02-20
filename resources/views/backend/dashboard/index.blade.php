@extends('layouts.app')
@section('content')
    <h1>Дашборд</h1>

    Товаров: {{ $products->count() }}
@endsection