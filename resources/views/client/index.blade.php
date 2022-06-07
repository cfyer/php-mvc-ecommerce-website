@extends('client.layouts.app')

@section('title', 'Home')

@section('content')
    <h1>Home Page Here ...</h1>
    <hr>
    <div class="container">
        @include('client.layouts.messages')
        <form action="/form/" method="post">
            <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">
            <input type="text" name="name" placeholder="name:"><br>
            <input type="text" name="email" placeholder="email:"><br>
            <button type="submit">Go</button>
        </form>
    </div>
@endsection
