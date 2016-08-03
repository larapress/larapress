@extends('larapress::layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h3>Showing All Administrators</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <a href="{!!route('larapress.administrators.create')!!}" class="btn btn-primary navbar-btn">
                            Create Administrator
                        </a>

                        <form action="{!!route('larapress.administrators.search')!!}" class="navbar-form navbar-right"
                              role="search" method="post">
                            <div class="form-group">
                                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                <input type="text" name="term" class="form-control"
                                       placeholder="Search for administrator by name">
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


    @if(count($administrators) < 1)
        <h2>There are no administrators</h2>
    @else
        @foreach($administrators as $administrator)
            @include('larapress::administrator.panel')
        @endforeach

        <div class="row">
            <div class="col-xs-12">
                {!!$administrators->render()!!}
            </div>
        </div>
    @endif




@stop
