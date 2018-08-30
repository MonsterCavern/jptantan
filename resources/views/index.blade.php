<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Also want these pretty website previews?" />
    <meta property="og:title" content="Jptantan" />
    <meta property="og:description" content="Jptantan is translate web site" />
    {{-- <meta property="og:image" content="" /> --}}
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('common.'.config('app.name'),[],config('app.name')) }}</title>
    <base href="{{url('/')}}">

    <link rel="shortcut icon" href="{{url('favicon.ico')}}" />
    <!-- Fonts -->
    {{--
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet"> --}}
    <!-- Styles -->
    <link href="{{ url(mix('css/app.css')) }}" rel="preload" as="style" onload="this.rel='stylesheet'"> {{-- Google Adsense --}}
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
    (adsbygoogle = window.adsbygoogle || [])
    .push(
    {
        google_ad_client: "ca-pub-2686993499673181",
        enable_page_level_ads: true
    });
    </script>
    <style>
        [v-cloak] { display: none;}
    </style>

</head>

<body>
    <div v-cloak id="app"></div>
</body>

<!-- Scripts -->
<script src="{{ url(mix('js/app.js')) }}" charset="utf-8" defer></script>

</html>