@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Create New Gallery</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::open(['route' => 'larapress.galleries.store', 'files' => true]) !!}
        @include('larapress::galleries.form')
        {!!Form::close()!!}
    </div>
</div>
@stop