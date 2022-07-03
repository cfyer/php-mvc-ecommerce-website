@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
    <h1 class="text-center mt-2">Users</h1>
    <div class="container mt-5">
        <div class="row">
            @include('admin.layouts.messages')
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>fullname</th>
                        <th>mail</th>
                        <th>role</th>
                        <td>info</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#model{{ $user->id }}">
                                    user info
                                </button>
                                <div class="modal fade" id="model{{ $user->id }}" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $user->fullname }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <strong>email: </strong> {{ $user->email }} <br>
                                                <strong>username:</strong> {{ $user->username }} <br>
                                                <strong>role:</strong> {{ $user->role }} <br>
                                                <strong>address:</strong> {{ $user->address }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">close</button>
                                                <form action="/admin/users/{{ $user->id }}/delete/" method="POST">
                                                    <input
                                                        onclick="if (! confirm('Are you sure delete this item?')) { return false; }"
                                                        type="submit" value="delete" class="btn btn-danger btn-sm">
                                                </form>
                                                <a href="/admin/users/{{ $user->id }}/edit"
                                                    class="btn btn-success btn-sm">edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {!! $links !!}
            </div>
        </div>
    </div>
@endsection
