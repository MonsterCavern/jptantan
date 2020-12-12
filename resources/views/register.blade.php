@extends('app')

@section('content')
<div class="content pure-u-1 pure-u-md-3-4">
    <form class="pure-form" action="/messages" method="POST">
        @CSRF
        <fieldset class="pure-group">
            <input type="text" value="name" name="name" class="pure-input-1-2" placeholder="Username" />
            <!--    <input type="text" class="pure-input-1-2" placeholder="Password" /> -->
            <input type="text" value="password" name="password" class="pure-input-1-2" placeholder="Password" />
            <input type="email" value="email" name="email" class="pure-input-1-2" placeholder="Email" />
        </fieldset>
        <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">Sign up</button>
    </form>

</div>
@endsection
