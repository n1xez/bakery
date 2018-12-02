@extends('layouts.master')

@section('title', 'Магазин')

@section('content')
<div class="container">
    <h1>Пользователи</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Email</th>
            <th scope="col">Администратор</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Дата изменения</th>
            <th scope="col">Редактировать</th>
        </tr>
        </thead>
        <tbody>
        @foreach($models as $model)
            <tr>
                <th scope="row">{{ $model->id }}</th>
                <td>{{ $model->name }}</td>
                <td>{{ $model->email }}</td>
                <td>{{ $model->is_admin }}</td>
                <td>{{ $model->created_at }}</td>
                <td>{{ $model->updated_at }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('users.edit', $model->id) }}">
                        Редактировать
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection