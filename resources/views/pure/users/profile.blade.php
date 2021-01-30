@extends('pure.layouts.app')


@section('content')
{{-- --}}
<div class="main">
    <h2 class="content-head is-center">個人資料</h2>
    <div class="pure-g">
        <div class="l-box-lrg pure-u-1">
            <form class="pure-form pure-form-aligned" action="{{ route('users.update',['user' => $user->id]) }}"
                method="post">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <fieldset>
                    <div class="pure-control-group">
                        <label for="email">Email</label>
                        <input disabled name="email" type="email" placeholder="Your Email" @error('email') is-invalid
                            @enderror value="{{ old('email', $user->email) }}" class="pure-u-2-5">
                        @error('email')
                        <span class="pure-form-message-inline">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="pure-control-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" placeholder="Your Name" @error('name') is-invalid @enderror
                            value="{{ old('name', $user->name) }}" class="pure-u-2-5">
                        @error('name')
                        <span class="pure-form-message-inline">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="pure-control-group">
                        <label for="name">Token</label>
                        <textarea rows="2" class="pure-u-2-5" disabled> {{ $token ?? '' }}</textarea>
                    </div>

                    <div class="pure-controls">
                        <button type="submit" class="pure-button pure-button-primary">Update</button>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>


@endsection
