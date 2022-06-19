@extends('client.layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container my-4">
        <h1 class="text-center">Register</h1>
        <div class="row">
            <div class="col-12 col-md-5 mx-auto">
                @include('client.layouts.messages')
                <form action="/register/" method="post">
                    <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">

                    <label for="fullname">full name:</label>
                    <input type="text" name="fullname" class="form-control mb-3">

                    <label for="email">email:</label>
                    <input type="email" name="email" class="form-control mb-3">

                    <label for="username">username:</label>
                    <input type="text" name="username" class="form-control mb-3">

                    <label for="password">password:</label>
                    <input type="password" name="password" class="form-control mb-3">

                    <label for="address">address:</label>
                    <textarea name="address" class="form-control mb-3" rows="1"></textarea>

                    <input type="submit" value="Register" class="btn btn-primary btn-sm">
                    <span class="ms-3">Already registered? <a href="/login">Login Here</a></span>
                </form>
            </div>
        </div>
    </div>
@endsection
