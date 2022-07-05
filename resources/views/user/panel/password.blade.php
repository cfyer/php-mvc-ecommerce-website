@extends('user.layouts.app')

@section('title', 'Edit Password')

@section('content')
    <section class="profile container mt-5">
        <div class="row">
            <div class="col-12 col-md-8 col-xl-6 bg-light rounded p-3 mx-auto">
                @include('general.layouts.messages')
                <div class="profile-header">
                    <h4 class="text-center">Edit Password</h4>
                    <hr>
                </div>
                <div class="profile-body">
                    <form action="/panel/{{ $user->id }}/update/password" method="post">
                        <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">

                        <label for="username">old password: </label>
                        <input type="password" name="oldPassword" class="form-control mb-3">

                        <label for="username">new password: </label>
                        <input type="password" name="newPassword" class="form-control mb-3">

                        <input type="submit" value="update" class="btn btn-sm btn-success">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
