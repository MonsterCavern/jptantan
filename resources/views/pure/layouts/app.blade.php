<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="一個日文網站的翻譯農場">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Jptantan') }}</title>
    <link rel="stylesheet" href="{{ asset('css/pure/pure-min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/pure/grids-responsive-min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/pure/styles.css') }}">
</head>

<body>
    <div id="layout" class="pure-g">
        <div class="sidebar pure-u-1 pure-u-md-1-4" style="height: 100%;">
            <div class="header">
                <h1 class="brand-title">

                    <a href="/">Jptantan</a>
                </h1>
                <h2 class="brand-tagline">一個日文網站的<br>翻譯農場</h2>

                @auth
                <div class="brand-tagline">
                    <h2> Hi, {{ auth()->user()->name }} </h2>
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button type="submit" class="pure-button">登出</button>
                    </form>
                </div>
                @endauth

                <nav class="nav">
                    <ul class="nav-list">
                        @guest
                        <li class="nav-item">
                            <a class="pure-button" href="/login">開始使用</a>
                        </li>
                        @endguest
                        <li class="nav-item">
                            <a class="pure-button" href="/message">問題回饋</a>
                        </li>

                        <li class="nav-item">
                            <div class="pure-g">
                                <div class="pure-u-md-1 pure-u-sm-1-2" style="margin:2px;">
                                    <a class="pure-button" target="_blank" href="https://bokete.jp">Bokete</a>
                                </div>

                                <div class="pure-u-md-1 pure-u-sm-1-2" style="margin:2px;">
                                    <a class=" pure-button" target="_blank" href="https://syosetu.com">小説家になろう</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        {{-- --}}
        @yield('content')
        {{-- --}}

    </div>
    {{-- include js  --}}
    @stack('js-package')
    @stack('js-main')
</body>

</html>