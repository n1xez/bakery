@extends('layouts.master')

@section('title', 'Page title')

@section('content')
{{ Form::open([
    'url' => route('assortments.store'),
    'method' => 'post',
]) }}
    <h1>Создание нового ассортимента</h1>
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
        {{ Form::number('quantity', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('warning_quantity', 'Красная зона') }}
        {{ Form::number('warning_quantity', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Создать!', ['class' => 'btn btn-primary']) }}
        <a class="btn btn-secondary" href="{{ route('assortments.index') }}">Назад</a>
    </div>
{{ Form::close() }}
@endsection