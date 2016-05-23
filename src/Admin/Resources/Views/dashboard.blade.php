@extends('larapress::layouts.master')


@section('content')
{!!var_dump(\Auth::check())!!}
    <h3>Dashboard</h3>


@stop