@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Portfolios</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <a href="{!!route('larapress.portfolio.create')!!}" class="btn btn-primary navbar-btn">Create Project</a>

                    <form action="{!!route('larapress.portfolio.search')!!}" class="navbar-form navbar-right" role="search" method="post">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <input type="text" name="term" class="form-control" placeholder="Search for portfolio by title">
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


@foreach($portfolio as $project)
@include('larapress::portfolio.panel')
@endforeach

<div class="row">
    <div class="col-xs-12">
        {!!$portfolio->render()!!}
    </div>
</div>

@stop