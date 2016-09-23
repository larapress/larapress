@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Edit {Model}: {!!${model}->title!!}</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::model(${model}, ['route' => ['larapress.{models}.update', ${model}->id], 'files' => true, 'method' => 'put'])
        !!}
        @include('{package}::{models}.form')
        {!!Form::close()!!}
    </div>
</div>

@stop