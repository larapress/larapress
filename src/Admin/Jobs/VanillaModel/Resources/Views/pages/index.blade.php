@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Your web applications pages</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <a href="{!!route('larapress.pages.create')!!}" class="btn btn-primary navbar-btn">Create Page</a>

                    <form action="{!!route('larapress.pages.search')!!}" class="navbar-form navbar-right" role="search" method="post">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <input type="text" name="term" class="form-control" placeholder="Search for page by title">
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


@foreach($pages as $page)
@include('larapress::pages.panel')
@endforeach

<div class="row">
    <div class="col-xs-12">
        {!!$pages->render()!!}
    </div>
</div>

@stop