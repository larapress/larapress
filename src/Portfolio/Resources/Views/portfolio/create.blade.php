@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Create New Project</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::open(['route' => 'larapress.portfolio.store', 'files' => true]) !!}
        @include('larapress::portfolio.form')
        {!!Form::close()!!}
    </div>
</div>
@stop