@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <h1 calss="mt-0 mb-0">Характеристики</h1>
        </div>
        <div class="col-12 col-md-6 text-right">
            <a href="/backend/details/new" class="btn btn-primary">Добавить</a>
        </div>
    </div>
    
    <table class="table table-bordered table-hover">
        @foreach($details as $detail)
            <tr>
                <td style="width: 80%;">
                    {{ $detail->title }}
                    <br><small>{{ $detail->code }}</small>
                </td>
                <td class="text-center">
                    <a href="{{ route('detail.edit', $detail->id) }}" class="btn btn-sm btn-warning">Правка</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection