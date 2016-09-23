@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Edit Page: {!!$page->title!!}</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::model($page, ['route' => ['larapress.pages.update', $page->id], 'files' => true, 'method' => 'put'])
        !!}
        @include('larapress::pages.form')
        {!!Form::close()!!}
    </div>
</div>

@stop