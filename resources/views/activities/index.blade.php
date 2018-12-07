@extends('layouts.master')

@section('title', 'Отчет нехватки товаров')

@section('content')
    <div class="container" id="report">
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
            <div class="float-right">
                <label class="radio-inline"><input type="radio" class="picker" name="date_picker" value="today"> Сегодня</label>
                <label class="radio-inline"><input type="radio" class="picker" name="date_picker" value="yesterday"> Вчера</label>
                <label class="radio-inline"><input type="radio" class="picker" name="date_picker" value="on_week"> За неделю</label>
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
            @php $maxSec = $activities->max('seconds') @endphp
            @foreach($activities as $activity)
                <tr>
                    <td scope="row">{{ $activity->assortment->shop->title }}</td>
                    <td>{{ $activity->assortment->product->title }}</td>
                    <td><span class="badge badge__{{ $activity->color }}">{{ $activity->color }}</span></td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar progress-{{ $activity->color}}"
                                 role="progressbar"
                                 style="width: {{ $activity->seconds / $maxSec * 100 }}%;"
                                 aria-valuenow="{{ $activity->seconds / $maxSec * 100 }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">{{ $activity->time }}</div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection