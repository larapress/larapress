@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Your web applications {models}</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <a href="{!!route('larapress.{models}.create')!!}" class="btn btn-primary navbar-btn">Create {Model}</a>

                    <form action="{!!route('larapress.{models}.search')!!}" class="navbar-form navbar-right" role="search" method="post">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <input type="text" name="term" class="form-control" placeholder="Search for {model} by title">
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </div>
</div>


@foreach(${models} as ${model})
@include('{package}::{models}.panel')
@endforeach

<div class="row">
    <div class="col-xs-12">
        {!!${models}->render()!!}
    </div>
</div>

@stop