@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Create New Post</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::open(['route' => 'larapress.posts.store', 'files' => true]) !!}
        @include('larapress::posts.form')
        {!!Form::close()!!}
    </div>
</div>
@stop