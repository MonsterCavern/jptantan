<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('common.'.config('app.name'),[],config('app.name')) }}</title>
    <base href="{{url('/')}}">

    <link rel="shortcut icon" href="{{url('favicon.ico')}}" />
    <!-- Fonts -->
    {{--
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet"> --}}
    <!-- Styles -->
    <link href="{{ url(mix('css/app.css')) }}" rel="stylesheet">
    
    {{-- Google Adsense --}}
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
    (adsbygoogle = window.adsbygoogle || [])
    .push(
    {
        google_ad_client: "ca-pub-2686993499673181",
        enable_page_level_ads: true
    });
    </script>

</head>

<body>
    <div id="app"></div>
</body>

<!-- Scripts -->
<script src="{{ url(mix('js/app.js')) }}" charset="utf-8" defer></script>

</html>
