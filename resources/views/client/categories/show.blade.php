@extends('client.layouts.app')

@section('title', $category->name)

@section('content')
    <div class="container-fluid my-4">
        <h1 class="mb-4">{{ $category->name }} products</h1>
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="/">Home</a>
                    <span class="breadcrumb-item active" aria-current="page">{{ $category->name }}</span>
                </nav>
            </div>
            @foreach ($products as $product)
                @include('client.layouts.single_product')
            @endforeach
        </div>
    </div>
@endsection
