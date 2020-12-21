@extends('pure.layouts.app')

@section('content')
<div class="main">
    <!-- A wrapper for all the blog posts -->
    <div class="posts">
        <h1 class="content-subhead">Pinned Post</h1>

        <!-- A single blog post -->
        <section class="post">
            <header class="post-header">
                <img width="48" height="48" alt="Tilo Mitra&#x27;s avatar" class="post-avatar" src="https://via.placeholder.com/128/128">

                <h2 class="post-title">Introducing Pure</h2>

                <p class="post-meta">
                    By <a href="#" class="post-author">Tilo Mitra</a> under <a class="post-category post-category-design" href="#">CSS</a> <a class="post-category post-category-pure" href="#">Pure</a>
                </p>
            </header>

            <div class="post-description">
                <p>
                    Yesterday at CSSConf, we launched Pure – a new CSS library. Phew! Here are the <a href="https://speakerdeck.com/tilomitra/pure-bliss">slides from the presentation</a>. Although it looks pretty minimalist, we’ve been working on Pure for several months. After many iterations, we have released Pure as a set of small, responsive, CSS modules that you can use in every web project.
                </p>
            </div>
        </section>
    </div>

    <div class="posts">
        <h1 class="content-subhead">Recent Posts</h1>

        <section class="post">
            <header class="post-header">
                <img width="48" height="48" alt="Eric Ferraiuolo&#x27;s avatar" class="post-avatar" src="https://via.placeholder.com/128/128">

                <h2 class="post-title">Everything You Need to Know About Grunt</h2>

                <p class="post-meta">
                    By <a class="post-author" href="#">Eric Ferraiuolo</a> under <a class="post-category post-category-js" href="#">JavaScript</a>
                </p>
            </header>

            <div class="post-description">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                </p>
            </div>
        </section>

        <section class="post">
            <header class="post-header">
                <img width="48" height="48" alt="Reid Burke&#x27;s avatar" class="post-avatar" src="https://via.placeholder.com/128/128">

                <h2 class="post-title">Photos from CSSConf and JSConf</h2>

                <p class="post-meta">
                    By <a class="post-author" href="#">Reid Burke</a> under <a class="post-category" href="#">Uncategorized</a>
                </p>
            </header>

            <div class="post-description">
                <div class="post-images pure-g">
                    <div class="pure-u-1 pure-u-md-1-2">
                        <a href="#">
                            <img alt="Photo of someone working poolside at a resort" class="pure-img-responsive" src="https://via.placeholder.com/500/375">
                        </a>

                        <div class="post-image-meta">
                            <h3>CSSConf Photos</h3>
                        </div>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-2">
                        <a href="http://www.flickr.com/photos/uberlife/8907351301/">
                            <img alt="Photo of the sunset on the beach" class="pure-img-responsive" src="https://via.placeholder.com/500/375">
                        </a>

                        <div class="post-image-meta">
                            <h3>JSConf Photos</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="post">
            <header class="post-header">
                <img width="48" height="48" alt="Andrew Wooldridge&#x27;s avatar" class="post-avatar" src="https://via.placeholder.com/128/128">

                <h2 class="post-title">YUI 3.10.2 Released</h2>

                <p class="post-meta">
                    By <a class="post-author" href="#">Andrew Wooldridge</a> under <a class="post-category post-category-yui" href="#">YUI</a>
                </p>
            </header>

            <div class="post-description">
                <p>
                    We are happy to announce the release of YUI 3.10.2! You can find it now on the Yahoo! CDN, download it directly, or pull it in via npm. We’ve also updated the YUI Library website with the latest documentation.
                </p>
            </div>
        </section>
    </div>
</div>
@endsection