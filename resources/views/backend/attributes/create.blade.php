@extends('layouts.app')
@section('content')

    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12">
                <h1>Новый пункт характеристик</h1>
            </div>
        </div>

        <form action="/backend/attributes" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-4">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">Название</label>
                        <input type="text" class="form-control" name="name" placeholder="Название категории">
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                Укажите название
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="code" class="font-weight-bold">Идентификатор</label>
                        <input type="text" class="form-control" name="code" placeholder="Идентификатор">
                        @if ($errors->has('code'))
                            <div class="alert alert-danger">
                                Укажите идентификатор
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="filter" class="font-weight-bold">Добавить в фильтр</label>
                        <select name="filter" class="form-control">
                            <option value="y" selected>Да</option>
                            <option value="n">Нет</option>
                        </select>
                        @if ($errors->has('filter'))
                            <div class="alert alert-danger">
                                Укажите
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-lg btn-success">Сохранить</button>
        </form>
    </div>

@endsection