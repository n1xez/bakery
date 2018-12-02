@extends('layouts.master')

@section('title', 'Page title')

@section('content')
{{ Form::model($model, [
       'url' => route('users.update', $model->id),
       'method' => 'PATCH',
   ]) }}
        <h1>Изменение продукта</h1>
        <div class="form-group">
            {{ Form::label('name', 'Имя') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', null, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('is_admin', 'Администратор') }}
            {{ Form::checkbox('is_admin', null, $model->is_admin) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Обновить!', ['class' => 'btn btn-primary']) }}
            <a class="btn btn-secondary" href="{{ route('users.index') }}">Отмена</a>
        </div>
{{ Form::close() }}
@endsection