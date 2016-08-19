@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Create Administrator</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::open(['route' => 'larapress.administrators.store', 'files' => true]) !!}
        @include('larapress::administrators.form')
        {!!Form::close()!!}
    </div>
</div>
@stop