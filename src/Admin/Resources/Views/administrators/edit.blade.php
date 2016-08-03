@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Edit Post: {!!$post->title!!}</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::model($post, ['route' => ['larapress.posts.update', $post->id], 'files' => true, 'method' => 'put'])
        !!}
        @include('larapress::posts.form')
        {!!Form::close()!!}
    </div>
</div>

@stop