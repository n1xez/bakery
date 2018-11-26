@extends('layouts.master')

@section('title', 'Page title')

@section('content')
    <div class="container">
        <h1>Отчет нехватки товаров</h1>
        {{ Form::open(['url' => route('report'), 'method' => 'get', ]) }}
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label('shop_id', 'Точка') }}
                    {{ Form::select('shop_id',
                         \App\Models\Shops\Shop::all()->pluck('title', 'id')->put(0, ''),
                         isset($shop_id) ? $shop_id : 0,
                         ['class' => 'form-control']
                     ) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('start_date', 'С') }}
                    {{ Form::date('start_date', $start_date, ['class' => 'form-control']) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('finish_date', 'По') }}
                    {{ Form::date('finish_date', $finish_date, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::submit('Получить', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Точка</th>
                <th scope="col">Продукт</th>
                <th scope="col">Цвет</th>
                <th scope="col">Время</th>
            </tr>
            </thead>
            <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td scope="row">{{ $activity->assortment->shop->title }}</td>
                    <td>{{ $activity->assortment->product->title }}</td>
                    <td>{{ $activity->color }}</td>
                    <td>{{ $activity->time }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection