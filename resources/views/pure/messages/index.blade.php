@extends('pure.layouts.app')

<head>
    <link rel="stylesheet" href="/css/pure/pure-min.css">
    <link rel="stylesheet" href="/css/pure/grids-responsive-min.css">
    <link rel="stylesheet" href="/layouts/blog/styles.css">
    <title>訊息頁面</title>
</head>

@section('content')

<h1 class="content-subhead">問題回報</h1>

<form class="pure-form" action="/messages" method="POST">
    @CSRF
    <fieldset class=" pure-group">
        <input name="email" type="text" class="pure-input-1-2" placeholder="信箱" />
    </fieldset>
    <fieldset class=" pure-group">
        <input name="nickname" type="text" class="pure-input-1-2" placeholder="你的暱稱" />
    </fieldset>
    <fieldset class="pure-group">
        <textarea name="content" class="pure-input-1-2" placeholder="你的訊息"></textarea>
    </fieldset>
    <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">送出</button>
</form>


<table class="pure-table">
    <thead>
        <tr>
            <th>樓層</th>
            <th>信箱</th>
            <th>暱稱</th>
            <th>內容</th>
            <th>日期</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($messages as $message)
        <tr>
            <td>{{ $message->id }}</td>
            <td>{{ $message->email }}</td>
            <td>{{ $message->nickname }}</td>
            <td>{{ $message->content }}</td>
            <td>{{ $message->created_at }}</td>
        </tr>
        @endforeach

    </tbody>
</table>


@endsection
