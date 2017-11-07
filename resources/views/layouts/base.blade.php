<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($title) ? $title.' | ' : '' }} {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{--
    <link href="{{ mix('build/css/app.css') }}" rel="stylesheet">
    --}}

    @include('layouts._favicons')
    
</head>
<body class="{{ $bodyClass ?? '' }}">

<div id="{{ $VueId ?? 'app' }}">
    @include('layouts._nav')

    @yield('body')

    @include('layouts._footer')
</div>
@yield('js')
{{--
<script src="{{ mix('build/js/app.js') }}"></script>

@include('layouts._intercom')
--}}
</body>
</html>
