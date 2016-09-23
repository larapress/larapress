@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Create New {Model}</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::open(['route' => 'larapress.{models}.store', 'files' => true]) !!}
        @include('{package}::{models}.form')
        {!!Form::close()!!}
    </div>
</div>
@stop