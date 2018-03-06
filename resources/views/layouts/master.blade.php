<html lang="{{ app()->getLocale() }}">
@yield('head')
<body>
    <div id="app">
        @yield('content')
    </div>
</body>

<footer>
<script type="text/javascript" charset="UTF-8" src="{{ mix('/js/app.js')}}"></script>

</footer>
</html>
