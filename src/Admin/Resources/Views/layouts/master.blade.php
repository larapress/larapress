<!doctype html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="{!!\URL::to('images/favicon.png')!!}"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" id="csrf_token" content="{!! csrf_token() !!}"/>

    @yield('meta')

    @if(env('APP_ENV') == 'local')
        {!!HTML::style('css/vendor/larapress/admin/admin.css')!!}
    @else
        {!!HTML::style('larapress/css/larapress.css')!!}
    @endif
</head>

<body>

<div class="container">
    <div class="row">
        @include('larapress::common.header')
    </div>

    <div class="row">
        <div class="col-xs-2">
            @include('larapress::common.sidebar')
        </div>
        <div class="col-xs-10">

            @if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>
                        {!!\Session::get('success')!!}
                    </p>
                </div>
            @endif

            @yield('content')

            <media-manager></media-manager>
        </div>
    </div>

    <div class="row">
        @include('larapress::common.footer')
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.min.js"></script>

@if(env('APP_ENV') == 'local')
    <script src="/js/vendor/larapress/admin/larapress_vues.js"></script>
@else
    <script src="/js/main.js"></script>
@endif

@yield('scripts')
</body>
</html>