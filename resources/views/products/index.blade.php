@extends('layouts.master')

@section('title', 'Продукты')

@section('content')
<div class="container">
    <h1>Продукты</h1>
    <div class="form-group">
        <a class="btn btn-primary" href="{{ route('products.create') }}">Создать</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Артикл</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата изменения</th>
                <th scope="col">Редактировать</th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $model)
                <tr>
                    <th scope="row">{{ $model->id }}</th>
                    <td>{{ $model->title }}</td>
                    <td>{{ $model->article }}</td>
                    <td>{{ $model->created_at }}</td>
                    <td>{{ $model->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('products.edit', $model->id) }}">
                            Редактировать
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection