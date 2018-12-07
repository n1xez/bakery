@extends('layouts.master')

@section('title', 'Создание нового продукта')

@section('content')
{{ Form::open([
    'url' => route('products.store'),
    'method' => 'post',
]) }}
    <h1>Создание нового продукта</h1>
    <div class="form-group">
        {{ Form::label('title', 'Название') }}
        {{ Form::text('title', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('article', 'Артикл') }}
        {{ Form::text('article', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Создать!', ['class' => 'btn btn-primary']) }}
        <a class="btn btn-secondary" href="{{ route('products.index') }}">Назад</a>
    </div>
{{ Form::close() }}
@endsection