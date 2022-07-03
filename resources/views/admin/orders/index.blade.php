@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
    <h1 class="text-center mt-2">Orders</h1>
    <div class="container mt-5">
        <div class="row">
            @include('admin.layouts.messages')
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>user</th>
                        <th>status</th>
                        <th>info</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->username }}</td>
                            <td>
                                @if ($order->status == 'paid')
                                    <span class="badge bg-success">paid</span>
                                @else
                                    <span class="badge bg-danger">unpaid</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#model{{ $order->id }}">
                                    order info
                                </button>
                                <div class="modal fade" id="model{{ $order->id }}" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <strong>id: </strong> {{ $order->id }} <br>
                                                <strong>user: </strong> {{ $order->user->username }} <br>
                                                <strong>total price: </strong> {{ $order->total_price }} <br>
                                                <strong>ref_code: </strong> <small>{{ $order->ref_code }}</small> <br>
                                                <strong>date: </strong> {{ $order->created_at }} <br>
                                                <hr>
                                                <strong>items:</strong>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>product</th>
                                                            <th>quantity</th>
                                                            <th>amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->orderItems as $item)
                                                            <tr>
                                                                <td>{{$item->product->name}}</td>
                                                                <td>{{$item->quantity}}</td>
                                                                <td>{{$item->total_price}}</td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
