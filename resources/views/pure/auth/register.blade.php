@extends('pure.layouts.app')

@section('content')
<div class="main">
    <h2 class="content-head is-center">{{ __('Register') }}</h2>
    <div class="pure-g">
        <div class="l-box-lrg pure-u-1">
            <form class="pure-form pure-form-aligned" action="{{ route('register') }}" method="post">
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

                    <div class="pure-control-group">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="pure-u-2-5" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="pure-controls">
                        <button type="submit" class="pure-button pure-button-primary">{{ __('Register') }}</button>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection