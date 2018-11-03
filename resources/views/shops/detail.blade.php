@extends('layouts.master_clean')

@section('title', 'Page title')

@section('content')
<div class="container-fluid">
    <div class="row">
        @foreach($assortments as $assortment)
            <div class="col-4">
                <div class="panel" style="
                    height: 33vh;
                    /*display: flex;
                    justify-content: center;
                    align-items: center;*/
                    margin: 10px;
                    background: #DD2C00;
                    color: #fefefe;
                    border-radius: 20px;
                    border: 3px solid #B71C1C;
                ">
                    <div class="content">
                        <div class="count" style="font-size: 8em;
    line-height: 1em;
    margin-left: 20px;
">
                            {{ $assortment->countToCook }}
                        </div>
                        <div class="title" style="font-size: 4em;
                        font-family: 'appetitle';
    line-height: 1em;
    text-align: right;
    margin-right: 20px;
    overflow: hidden;
    height: 10vh;
">
                            {{ $assortment->product->title }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection



