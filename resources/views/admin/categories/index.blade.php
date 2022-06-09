@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
    <h1 class="text-center mt-2">Categories</h1>
    <div class="container mt-5">
        @include('admin.layouts.messages')
        <div class="col-12 col-md-8 col-lg-5 mb-5 mx-auto">
            <form action="/admin/categories/store/" method="post">
                <div class="d-flex">
                    <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">
                    <input type="text" name="name" placeholder="Category name:" class="form-control rounded-0">
                    <input type="submit" value="Go" class="btn btn-success rounded-0">
                </div>
            </form>
        </div>
        <table class="table table-bordered table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th>name</th>
                    <th>slug</th>
                    <th>operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td class="d-flex">
                            <a href="/admin/categories/{{ $category->id }}/edit/" class="btn btn-info btn-sm mx-1">edit</a>
                            <form action="/admin/categories/{{ $category->id }}/delete/" method="post">
                                <input onclick="if (! confirm('Are you sure delete this item?')) { return false; }"
                                    type="submit" value="delete" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {!! $links !!}
        </div>
    </div>
@endsection
