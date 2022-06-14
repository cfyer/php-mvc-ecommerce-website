@extends('client.layouts.app')

@section('title', 'Products')

@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            @foreach ($products as $product)
                @include('client.layouts.single_product')
            @endforeach

            <div class="d-flex justify-content-center">
                {!! $links !!}
            </div>
        </div>
    </div>
@endsection
