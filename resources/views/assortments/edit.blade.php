@extends('layouts.master')

@section('title', 'Page title')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



{{ Form::model($model, [
       'url' => route('assortments.update', $model->id),
       'method' => 'PATCH',
   ]) }}
    <h1>Изменение ассортимента</h1>
    <div class="form-group">
        {{ Form::label('shop_id', 'Магазин') }}
        {{ Form::select('shop_id',
             \App\Models\Shops\Shop::all()->pluck('title', 'id'),
            null, ['class' => 'form-control'])
        }}
    </div>
    <div class="form-group">
        {{ Form::label('product_id', 'Продукт') }}
        {{ Form::select('product_id',
             \App\Models\Products\Product::all()->pluck('title', 'id'),
             null, ['class' => 'form-control'])
         }}
    </div>
    <div class="form-group">
        {{ Form::label('quantity', 'Текущие количество') }}
        {{ Form::number('quantity', null, ['class' => 'form-control', 'readonly']) }}
    </div>
    <div class="form-group">
        {{ Form::label('warning_quantity', 'Желтая зона') }}
        {{ Form::number('yellow_quantity', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('warning_quantity', 'Красная зона') }}
        {{ Form::number('warning_quantity', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Обвноить!', ['class' => 'btn btn-primary']) }}
        <a class="btn btn-secondary" href="{{ route('assortments.index') }}">Отмена</a>
    </div>
{{ Form::close() }}
@endsection