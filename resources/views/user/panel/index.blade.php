@extends('user.layouts.app')

@section('title', 'User Panel')

@section('content')
    <a href="/" class="btn btn-danger btn-sm m-2"><i class="icofont-exit"></i></a>
    <section class="profile container mt-5">
        <div class="row">
            <div class="col-12 col-md-8 col-xl-6 bg-light rounded p-3 mx-auto">
                @include('general.layouts.messages')
                <div class="profile-header">
                    <h4 class="text-center">{{ \App\Core\Session::get('SESSION_USER_NAME') }}</h4>
                    <hr>
                </div>
                <div class="profile-body">
                    <strong>
                        <i class="icofont-user"></i> username:
                    </strong> {{ $user->username }}<br>
                    <strong>
                        <i class="icofont-ui-email"></i> email:
                    </strong> {{ $user->email }}<br>
                    <strong>
                        <i class="icofont-home"></i> address:
                    </strong> {{ $user->address }}<br>
                </div>
                <div class="profile-footer mt-4 d-flex justify-content-between">
                    <div class="d-flex">
                        <a href="/panel/{{ $user->id }}/edit" class="btn btn-success btn-sm me-1">edit</a>
                        <a href="/panel/{{ $user->id }}/edit/password" class="btn btn-warning btn-sm me-1">edit
                            password</a>
                        <form action="/logout/" method="POST">
                            <input type="submit" value="logout" class="btn btn-danger btn-sm me-1">
                        </form>
                    </div>
                    <div>
                        <a href="/panel/{{ $user->id }}/orders" class="btn btn-info btn-sm">orders</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
