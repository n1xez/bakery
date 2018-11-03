@extends('layouts.master')

@section('title', 'Page title')

@section('content')
{{ Form::open([
    'url' => route('shops.store'),
    'method' => 'post',
]) }}
    <h1>Создание нового магазина</h1>
    <div class="form-group">
        {{ Form::label('title', 'Название') }}
        {{ Form::text('title', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('address', 'Адресс') }}
        {{ Form::text('address', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Описание') }}
        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Создать!', ['class' => 'btn btn-primary']) }}
        <a class="btn btn-secondary" href="{{ route('shops.index') }}">Назад</a>
    </div>
{{ Form::close() }}
@endsection