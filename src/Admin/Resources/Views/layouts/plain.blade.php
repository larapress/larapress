<!doctype html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="{!!\URL::to('images/favicon.png')!!}"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" id="csrf_token" content="{!! csrf_token() !!}"/>

    @yield('meta')

    @if(env('APP_ENV') == 'local')
        {!!HTML::style('larapress/css/admin.css')!!}

    @else
        {!!HTML::style('larapress/css/larapress.css')!!}
    @endif
</head>

<body class="skin-blue fixed">

<div class="wrapper">
    @include('larapress::common.header')

    <div class="content-wrapper">
        <div class="col-xs-12">
            @if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>
                        {!!\Session::get('success')!!}
                    </p>
                </div>
            @endif

                @if(\Session::has('error'))
                    <div class="alert alert-error">
                        <p>
                            {!!\Session::get('error')!!}
                        </p>
                    </div>
                @endif

            @yield('content')

        </div>
    </div>
</div>

<div class="row">
    @include('larapress::common.footer')
</div>

@yield('scripts')
</body>
</html>