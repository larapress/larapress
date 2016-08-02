@extends('larapress::layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h3>{!! $title !!}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <a href="{!!route('larapress.posts.create')!!}" class="btn btn-primary navbar-btn">Create
                            post</a>

                        <form action="{!!route('larapress.posts.search')!!}" class="navbar-form navbar-right"
                              role="search" method="post">
                            <div class="form-group">
                                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                <input type="text" name="term" class="form-control"
                                       placeholder="Search for post by title">
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


    @if(count($posts) < 1)
        <h2>There are no blog posts in this category</h2>
    @else
        @foreach($posts as $post)
            @include('larapress::posts.panel')
        @endforeach

        <div class="row">
            <div class="col-xs-12">
                {!!$posts->render()!!}
            </div>
        </div>
    @endif




@stop
