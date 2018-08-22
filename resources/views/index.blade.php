<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <base href="{{url('/')}}">

    <link rel="shortcut icon" href="{{url('favicon.ico')}}"/>
    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet"> --}}
    <!-- Styles -->
    <link href="{{ url(mix('css/app.css')) }}" rel="stylesheet">
</head>

<body>
    <div id="app"></div>
</body>

<!-- Scripts -->
<script src="{{ url(mix('js/app.js')) }}" charset="utf-8" defer></script>

</html>
