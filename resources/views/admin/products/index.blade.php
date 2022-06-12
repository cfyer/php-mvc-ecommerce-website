@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
    <h1 class="text-center mt-2">Products</h1>
    <div class="container mt-5">
        <div class="row">
            @include('admin.layouts.messages')
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td class="d-flex">
                                <a href="/admin/products/{{ $product->id }}/edit/"
                                    class="btn btn-info btn-sm mx-1">edit</a>
                                <form action="/admin/products/{{ $product->id }}/delete/" method="post">
                                    <input onclick="if (! confirm('Are you sure delete this item?')) { return false; }"
                                        type="submit" value="delete" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {!! $links !!}
        </div>
    </div>
@endsection
