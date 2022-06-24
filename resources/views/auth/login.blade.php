@extends('client.layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container my-5">
        <h1 class="text-center">Login</h1>
        <div class="row">
            <div class="col-12 col-md-5 mx-auto">
                @include('client.layouts.messages')
                <form action="/login/" method="post">
                    <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">

                    <label for="username">username:</label>
                    <input type="text" name="username" class="form-control mb-3">

                    <label for="password">password:</label>
                    <input type="password" name="password" class="form-control mb-3">

                    <input type="submit" value="Login" class="btn btn-primary btn-sm">
                </form>
            </div>
        </div>
    </div>
@endsection
