@extends('layouts.master')

@section('title', 'Магазин')

@section('content')
<div class="container">
    <h1>Ассортимент</h1>
    <div class="form-group">
        <a class="btn btn-primary" href="{{ route('assortments.create') }}">Создать</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Пекарня</th>
            <th scope="col">Продукт</th>
            <th scope="col">Текущие количество</th>
            <th scope="col">Нормальное количество</th>
            <th scope="col">Критическое количество</th>
            <th scope="col">Объем производства</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Дата изменения</th>
            <th scope="col">Редактирвоать</th>
        </tr>
        </thead>
        <tbody>
        @foreach($models as $model)
            <tr>
                <th scope="row">{{ $model->id }}</th>
                <td>{{ $model->shop->title }}</td>
                <td>{{ $model->product->title }}</td>
                <td>{{ $model->quantity }}</td>
                <td>{{ $model->yellow_quantity }}</td>
                <td>{{ $model->warning_quantity }}</td>
                <td>{{ $model->volume_production }}</td>
                <td>{{ $model->created_at }}</td>
                <td>{{ $model->updated_at }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('assortments.edit', $model->id) }}">
                        Редактирвоать
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection