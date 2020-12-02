@extends('pure.layouts.app')

@section('content')
{{-- --}}
<div class="content pure-u-1">
    <h2 class="content-head is-center">登入</h2>
    <div class="pure-g">
        <div class="l-box-lrg pure-u-1">
            <form class="pure-form pure-form-aligned" action="/login" method="post">
                @csrf
                <fieldset>
                    <div class="pure-control-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" placeholder="Your Email" @error('email') is-invalid @enderror value="{{ old('email', 'cosmos-s@hotmail.com.tw') }}" class="pure-u-2-5">
                        @error('email')
                        <span class="pure-form-message-inline">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="pure-control-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" placeholder="Your Password" @error('password') is-invalid @enderror class="pure-u-2-5">
                        @error('password')
                        <span class="pure-form-message-inline">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="pure-controls">
                        <button type="submit" class="pure-button pure-button-primary">Submit</button>
                        <span>or <a href="/register">註冊</a></span>
                        <span>or <a href="/login/github">GitHub</a></span>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>

</div>


@endsection