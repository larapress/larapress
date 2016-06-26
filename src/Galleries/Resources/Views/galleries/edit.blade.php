@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Edit Page: {!!$gallery->title!!}</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::model($gallery, ['route' => ['larapress.gallery.update', $gallery->id], 'files' => true, 'method' => 'put'])
        !!}
        @include('larapress::gallery.form')
        {!!Form::close()!!}
    </div>
</div>

@stop