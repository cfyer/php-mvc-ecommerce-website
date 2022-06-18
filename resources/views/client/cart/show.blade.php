@extends('client.layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container my-4">
        <h5>Cart Items</h5>
        <div class="row">
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!is_null($cartItems))
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td>
                                    <img src="/{{ \App\Core\Cart::getProductImage($cartItem['id']) }}" width="60">
                                </td>
                                <td>
                                    {{ \App\Core\Cart::getProductName($cartItem['id']) }}
                                </td>
                                <td>
                                    ${{ \App\Core\Cart::getProductPrice($cartItem['id']) }}
                                </td>
                                <td>
                                    {{ $cartItem['quantity'] }}
                                    <button class="btn btn-sm incQty" data-productId="{{ $cartItem['id'] }}">+</button>
                                    <button class="btn btn-sm decQty" data-productId="{{ $cartItem['id'] }}">-</button>
                                </td>
                                <td>
                                    ${{ \App\Core\Cart::getTotalProductPrice($cartItem['id'], $cartItem['quantity']) }}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger remove" data-productId="{{ $cartItem['id'] }}">
                                        <i class="icofont icofont-close-line-circled "></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <h4 class="text-center">empty</h4>
                    @endif
                </tbody>
            </table>
            <section>
                <strong>Amount : ${{ \App\Core\Cart::getTotalAmount() }}</strong>
                <a href="#" class="btn btn-success btn-sm float-end">
                    <i class="icofont icofont-basket"></i>
                    Continue Shopping
                </a>
                <button id="removeAll" class="btn btn-danger btn-sm float-end mx-2">
                    <i class="icofont icofont-trash"></i>
                    Clear
                </button>
            </section>
        </div>
    </div>
@endsection
