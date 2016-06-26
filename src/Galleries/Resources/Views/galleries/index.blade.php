@extends('larapress::layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3>Your web applications galleries</h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <a href="{!!route('larapress.galleries.create')!!}" class="btn btn-primary navbar-btn">Create Gallery</a>

                    <form action="{!!route('larapress.galleries.search')!!}" class="navbar-form navbar-right" role="search" method="post">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <input type="text" name="term" class="form-control" placeholder="Search for gallery by title">
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


@foreach($galleries as $gallery)
@include('larapress::galleries.panel')
@endforeach

<div class="row">
    <div class="col-xs-12">
        {!!$galleries->render()!!}
    </div>
</div>

@stop