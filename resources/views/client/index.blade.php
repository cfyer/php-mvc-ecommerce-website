@extends('client.layouts.app')

@section('title', 'Home')

@section('content')
    @include('client.layouts.slider')

    <div class="container-fluid my-5">
        <h5 class="mb-3">New Products</h5>
        <div class="row">
            @foreach ($products as $product)
                @include('client.layouts.single_product')
            @endforeach
        </div>
    </div>
@endsection
