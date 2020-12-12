<head>
    <link rel="stylesheet" href="/css/pure/pure-min.css">
    <link rel="stylesheet" href="/css/pure/grids-responsive-min.css">
    <link rel="stylesheet" href="/layouts/blog/styles.css">
    <title>訊息頁面</title>
</head>

@foreach ($messages as $message)
<p>msg: {{ $message->context }}</p>
@endforeach


{{$test}}

<form class="pure-form" action="/messages" method="POST">
    @CSRF
    <fieldset class=" pure-group">
        <input name="name" type="text" class="pure-input-1-2" placeholder="暱稱" />
    </fieldset>
    <fieldset class="pure-group">
        <textarea name="context" class="pure-input-1-2" placeholder="訊息內容"></textarea>
    </fieldset>
    <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">提交</button>
</form>
