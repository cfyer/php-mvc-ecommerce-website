@extends('client.layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="/">Home</a>
                    <a class="breadcrumb-item" href="/products/">Products</a>
                    <a class="breadcrumb-item"
                        href="/categories/{{ $product->category->id }}/">{{ $product->category->name }}</a>
                    <span class="breadcrumb-item active" aria-current="page">{{ $product->name }}</span>
                </nav>
            </div>

            <div class="col-12 col-md-5">
                <img src="/{{ $product->image_path }}" alt="{{ $product->name }}" class="img-fluid rounded">
            </div>

            <div class="col-12 col-md-5">
                <h1>{{ $product->name }}</h1>
                <div>{!! $product->description !!}</div>
                <div class="mt-3">
                    <strong>${{ $product->price }}</strong>
                    @if ($product->quantity > 0)
                    <button class="btn btn-success btn-sm mx-2 addCart" data-productId="{{ $product->id }}">
                        Add to Cart
                    </button>
                    @else
                    <button class="btn btn-danger btn-sm mx-2 addCart" disabled>
                        Ended
                    </button>
                    @endif
                    <input type="hidden" name="quantity" id="quantity" value="1">
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <h3>Similar Products</h3>
            @foreach ($similarProducts as $product)
                @include('client.layouts.single_product')
            @endforeach
        </div>
    </div>
@endsection
