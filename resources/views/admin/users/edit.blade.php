@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
    <h1 class="text-center mt-2">Edit {{ $user->fullname }}</h1>
    <div class="container mt-5">
        <div class="col-12 col-md-8 col-lg-6 mb-5 mx-auto">
            @include('admin.layouts.messages')
            <form action="/admin/users/{{ $user->id }}/update/" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">

                <label for="name">fullname:</label>
                <input type="text" name="fullname" class="form-control mb-3" value="{{ $user->fullname }}">

                <label for="name">username:</label>
                <input type="text" name="username" class="form-control mb-3" value="{{ $user->username }}">

                <label for="quantity">role:</label>
                <select name="role" class="form-control mb-3">
                    <option @if ($user->role == 'user') selected @endif value="user">user</option>
                    <option @if ($user->role == 'admin') selected @endif value="admin">admin</option>
                </select>

                <input type="submit" value="Update" class="btn btn-success ">
            </form>
        </div>
    </div>
@endsection
