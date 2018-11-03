@extends('layouts.master')

@section('title', 'Магазин')

@section('content')
<div class="container">
    <h1>Магазины</h1>
    <div class="form-group">
        <a class="btn btn-primary" href="{{ route('shops.create') }}">Создать</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Адресс</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Дата изменения</th>
            <th scope="col">Редактирвоать</th>
            <th scope="col"><i class="fas fa-tv"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($models as $model)
            <tr>
                <th scope="row">{{ $model->id }}</th>
                <td>{{ $model->title }}</td>
                <td>{{ $model->address }}</td>
                <td>{{ $model->created_at }}</td>
                <td>{{ $model->updated_at }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('shops.edit', $model->id) }}">
                        Редактирвоать
                    </a>
                </td>
                <td><a class="btn btn-success" href="{{ route('shops.show', $model->id) }}"><i class="fas fa-tv"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection