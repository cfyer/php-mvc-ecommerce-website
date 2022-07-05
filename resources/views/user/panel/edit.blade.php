@extends('user.layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <section class="profile container mt-5">
        <div class="row">
            <div class="col-12 col-md-8 col-xl-6 bg-light rounded p-3 mx-auto">
                @include('general.layouts.messages')
                <div class="profile-header">
                    <h4 class="text-center">Edit Profile</h4>
                    <hr>
                </div>
                <div class="profile-body">
                    <form action="/panel/{{ $user->id }}/update" method="post">
                        <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">

                        <label for="username">username: </label>
                        <input type="text" name="username" class="form-control mb-3" value="{{ $user->username }}">

                        <label for="username">fullname: </label>
                        <input type="text" name="fullname" class="form-control mb-3" value="{{ $user->fullname }}">

                        <label for="address">address: </label>
                        <textarea name="address" rows="1" class="form-control mb-3">{{ $user->address }}</textarea>

                        <input type="submit" value="update" class="btn btn-sm btn-success">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
