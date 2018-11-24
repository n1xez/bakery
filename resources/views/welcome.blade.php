@extends('layouts.master')

@section('title', 'Магазин')

@section('content')

    {{ Form::open(['url' => 'foo/bar', 'files' => true] ) }}
    //
    {{ Form::close() }}

@endsection
