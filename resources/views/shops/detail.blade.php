@extends('layouts.master_clean')

@section('title', 'Пекарня')

@section('content')
<div class="container-fluid" id="monitor-from">
    <div class="row">
        @foreach($assortments as $assortment)
            <div class="col-md-4 col-sm-12">
                <div class="panel {{ $assortment->warningColor }}">
                    <div class="panel-content">
                        <div class="panel-content__count">
                            {{ $assortment->countToCook }}
                        </div>
                        <div class="panel-content__title">
                            {{ $assortment->product->title }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection



