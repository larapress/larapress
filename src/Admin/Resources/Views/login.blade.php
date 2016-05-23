@extends('larapress::layouts.master')

@section('content')
<div class="col-xs-6 col-xs-offset-3" style="margin-top: 10rem">
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"  class="form-control">
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