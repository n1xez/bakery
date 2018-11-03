@extends('layouts.master')

@section('title', 'Page title')

@section('content')
{{ Form::model($model, [
       'url' => route('products.update', $model->id),
       'method' => 'PATCH',
   ]) }}
        <h1>Изменение продукта</h1>
        <div class="form-group">
            {{ Form::label('title', 'Название') }}
            {{ Form::text('title', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('article', 'Артикл') }}
            {{ Form::text('article', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Обвноить!', ['class' => 'btn btn-primary']) }}
            <a class="btn btn-secondary" href="{{ route('products.index') }}">Отмена</a>
        </div>
{{ Form::close() }}
@endsection