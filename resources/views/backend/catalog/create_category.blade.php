@extends('layouts.app')
@section('content')

    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12">
                <h1>Новая категория</h1>
            </div>
        </div>

        <form action="/backend/catalog" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Название</label>
                        <input type="text" class="form-control" name="title" placeholder="Название категории">
                        @if ($errors->has('title'))
                            <div class="alert alert-danger">
                                <!--{{ $errors->first('title') }}-->
                                Укажите название
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Родительская категория</label>
                        <input name="parent_id" type="text" value="{{ $current_category }}">
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-lg btn-success">Сохранить</button>
        </form>
    </div>

@endsection