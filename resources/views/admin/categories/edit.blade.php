@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
    <h1 class="text-center mt-2">Edit {{ $category->name }}</h1>
    <div class="container mt-5">
        <div class="col-12 col-md-8 col-lg-5 mb-5 mx-auto">
            @include('admin.layouts.messages')
            <form action="/admin/categories/{{ $category->id }}/update/" method="post">
                <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">

                <label for="name">Category name:</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control rounded-0 mb-4">

                <input type="submit" value="Go" class="btn btn-success rounded-0">
            </form>
        </div>
    </div>
@endsection
