@extends('layouts.master')
@include('layouts.head')
@section('content')
<ul>
    <li>
        <router-link to="/">/</router-link>
    </li>
    <li>
        <router-link to="/translate">/translate</router-link>
    </li>
</ul>

<router-view></router-view>
<router-view name="ex"></router-view>
@endsection
