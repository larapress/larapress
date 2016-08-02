@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Edit Project: {!!$project->title!!}</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        {!! Form::model($project, ['route' => ['larapress.portfolio.update', $project->id], 'files' => true, 'method' => 'put'])
        !!}
        @include('larapress::portfolio.form')
        {!!Form::close()!!}
    </div>
</div>

@stop