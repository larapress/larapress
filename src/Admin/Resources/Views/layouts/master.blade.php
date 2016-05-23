<!doctype html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="{!!\URL::to('images/favicon.png')!!}"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{!! csrf_token() !!}"/>

    @yield('meta')

    {!!HTML::style('larapress/css/larapress.css')!!}
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

@include('larapress::vue_templates.all')


<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.21/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.min.js"></script>

<script src="/js/main.js"></script>

@yield('scripts')
</body>
</html>