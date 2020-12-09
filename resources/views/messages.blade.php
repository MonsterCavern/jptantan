@extends('app')

@section('content')
<div class="content pure-u-1 pure-u-md-3-4">
    <form class="pure-form" action="/messages" method="POST">
        @CSRF
        <fieldset class="pure-group">
            <input type="text" value="Cosmo" name="name" class="pure-input-1-2" placeholder="Username" />
            <!--    <input type="text" class="pure-input-1-2" placeholder="Password" /> -->
            <input type="email" value="email" name="email" class="pure-input-1-2" placeholder="Email" />
        </fieldset>
        <fieldset class="pure-group">
            <!--    <input type="text" class="pure-input-1-2" placeholder="A title" /> -->
            <textarea name="content" class="pure-input-1-2" placeholder="Textareas work too">
            1112234
            </textarea>
        </fieldset>
        <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">Sign in</button>
    </form>

</div>
@endsection
