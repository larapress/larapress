@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Create New Page</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::open(['route' => 'larapress.pages.store', 'files' => true]) !!}
        @include('larapress::pages.form')
        {!!Form::close()!!}
    </div>
</div>
@stop