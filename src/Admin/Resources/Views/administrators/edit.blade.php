@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Edit Administrator: {!!$administrator->name!!}</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::model($administrator, ['route' => ['larapress.administrators.update', $administrator->id], 'files' => true, 'method' => 'put'])
        !!}
        @include('larapress::administrators.form')
        {!!Form::close()!!}
    </div>
</div>

@stop