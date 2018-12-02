@extends('layouts.master')

@section('title', 'Page title')

@section('content')
{{ Form::model($model, [
       'url' => route('shops.update', $model->id),
       'method' => 'PATCH',
   ]) }}
        <h1>Изменение магазина</h1>
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
            {{ Form::submit('Обновить!', ['class' => 'btn btn-primary']) }}
            <a class="btn btn-secondary" href="{{ route('shops.index') }}">Отмена</a>
        </div>
{{ Form::close() }}
@endsection