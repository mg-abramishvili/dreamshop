@extends('layouts.app')
@section('content')

        <div class="row align-items-center mb-4">
            <div class="col-12">
                <h1>Правка пункта характеристик</h1>
            </div>
        </div>

        <form action="/backend/attributes/{{$attribute->id}}/update" method="post" enctype="multipart/form-data">@csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$attribute->id}}">

            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">Название</label>
                        <input type="text" class="form-control" name="name" placeholder="Название" value="{{ $attribute->name }}">
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                Укажите название
                            </div>
                        @endif
                    </div>
                </div>
                </div>

            </div>

            <button type="submit" class="btn btn-lg btn-success">Сохранить</button>
        </form>

        <div class="col-12">

                    @forelse($attribute->values as $value)
                        <p>{{ $value->value }}</p>
                    @empty
                        <p>Пусто</p>
                    @endforelse

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addValue">
                        Добавить значение
                    </button>

                    <div class="modal" id="addValue">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Новое значение</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('value.add', $attribute->id) }}" method="post" enctype="multipart/form-data">@csrf
                                        <input type="hidden" name="id" value="{{$attribute->id}}">
                                        <input type="text" name="value" class="form-control mb-3">
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-success">Добавить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection