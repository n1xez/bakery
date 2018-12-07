@extends('layouts.master')

@section('title', 'Ассортимент')

@section('content')
<div class="container">
    <h1>Ассортимент</h1>
    <div class="form-group">
        <a class="btn btn-primary" href="{{ route('assortments.create') }}">Создать</a>
    </div>
    {{ Form::open(['url' => route('assortments.index'), 'method' => 'get', ]) }}
    <div class="form-group row">
        <div class="col-md-2">
            {{ Form::submit('Фильтровать', ['class' => 'btn btn-primary']) }}
        </div>
        <div class="col-md-1">
            {{ Form::label('shop_id', 'Пекарня') }}
        </div>
        <div class="col-md-3">
            {{ Form::select('shop_id',
                 \App\Models\Shops\Shop::all()->pluck('title', 'id')->put(0, ''),
                 \Request::get('shop_id') ?? 0,
                 ['class' => 'form-control']
             ) }}
        </div>
    </div>
    {{ Form::close() }}
    <div class="table-responsive-sm">
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
                <th scope="col">Редактировать</th>
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