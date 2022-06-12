@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
    <h1 class="text-center mt-2">Edit {{ $product->name }}</h1>
    <div class="container mt-5">
        <div class="col-12 col-md-8 col-lg-6 mb-5 mx-auto">
            @include('admin.layouts.messages')
            <form action="/admin/products/{{$product->id}}/update/" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">

                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control mb-3" value="{{$product->name}}">

                <label for="price">Price:</label>
                <input type="number" name="price" class="form-control mb-3" value="{{$product->price}}">

                <label for="description">Description:</label>
                <textarea name="description" class="form-control mb-3" rows="10">{{$product->description}}</textarea>

                <label for="category_id">Category:</label>
                <select name="category_id" class="form-control mb-3">
                    @foreach ($categories as $category)
                        <option 
                        @if ($product->category_id == $category->id)
                            selected
                        @endif
                        value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="quantity">Quantity:</label>
                <select name="quantity" class="form-control mb-3">
                    @for ($i = 1; $i <= 50; $i++)
                        <option 
                        @if ($product->quantity == $i)
                            selected
                        @endif
                        value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <label for="image">Image:</label>
                <input type="file" name="image" class="form-control mb-3">

                <input type="submit" value="Update" class="btn btn-success ">
            </form>
        </div>
    </div>
@endsection
