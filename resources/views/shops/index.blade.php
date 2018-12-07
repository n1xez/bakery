@extends('layouts.master')

@section('title', 'Магазин')

@section('content')
<div class="container">
    <h1>Магазины</h1>
    <div class="form-group">
        @if(Auth::check() && Auth::user()->is_admin)
        <a class="btn btn-primary" href="{{ route('shops.create') }}">Создать</a>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><i style="margin-left: 11px;" class="fas fa-tv"></i></th>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Адресс</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата изменения</th>
                @if(Auth::check() && Auth::user()->is_admin)
                    <th scope="col">Редактировать</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($models as $model)
                <tr>
                    <td><a class="btn btn-success" href="{{ route('shops.show', $model->id) }}"><i class="fas fa-desktop"></i></a></td>
                    <th scope="row">{{ $model->id }}</th>
                    <td>{{ $model->title }}</td>
                    <td>{{ $model->address }}</td>
                    <td>{{ $model->created_at }}</td>
                    <td>{{ $model->updated_at }}</td>
                    @if(Auth::check() && Auth::user()->is_admin)
                        <td>
                            <a class="btn btn-primary" href="{{ route('shops.edit', $model->id) }}">
                                Редактировать
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection