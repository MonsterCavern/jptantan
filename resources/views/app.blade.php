<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a blog page with a list of posts.">
    <title>Blog &ndash; Layout Examples &ndash; Pure</title>
    <link rel="stylesheet" href="/css/pure-min.css">
    <link rel="stylesheet" href="/css/grids-responsive-min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>

    <div id="layout" class="pure-g">
        <div class="sidebar pure-u-1 pure-u-md-1-4">
            <div class="header">
                <h1 class="brand-title">A Sample Blog</h1>
                <h2 class="brand-tagline">Creating a blog layout using Pure</h2>

                <nav class="nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a class="pure-button" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="pure-button" href="/messages">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a class="pure-button" href="/register">Registger</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        @yield('content')
    </div>

</body>

</html>
