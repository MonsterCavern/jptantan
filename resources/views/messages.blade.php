@extends('app')

@section('content')
<div class="content pure-u-1 pure-u-md-3-4">
    <form class="pure-form" action="/messages" method="post">
        <fieldset class="pure-group">
            <input type="text" class="pure-input-1-2" placeholder="Username" />
            <input type="email" class="pure-input-1-2" placeholder="Email" />
        </fieldset>
        <fieldset class="pure-group">
            <textarea class="pure-input-1-2" placeholder="Messages"></textarea>
        </fieldset>
        <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">Send</button>
    </form>

</div>
@endsection