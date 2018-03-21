<html lang="{{ app()->getLocale() }}">
@yield('head')
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden sidebar-minimized">
    <div id="app">
        @yield('content')
    </div>
</body>

<footer>
<script type="text/javascript" charset="UTF-8" src="{{ mix('/js/app.js')}}"></script>
</footer>
</html>
