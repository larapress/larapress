@extends('larapress::layouts.plain')

@section('content')
<div class="col-xs-6 col-xs-offset-3" style="margin-top: 10rem">
    <form method="POST" action="{!! route('larapress.auth') !!}">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" name="email" value=""  class="form-control">
        </div>

        <div class="form-group">
            <label for="name">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <input type="checkbox" name="remember"> Remember Me
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>
@stop