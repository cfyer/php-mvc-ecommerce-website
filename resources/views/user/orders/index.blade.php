@extends('user.layouts.app')

@section('title', 'My Orders')

@section('content')
    <a href="/panel" class="btn btn-danger btn-sm m-2"><i class="icofont-exit"></i></a>
    <section class="orders container mt-5">
        <div class="row">
            <div class="col-12">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>total price</th>
                            <th>status</th>
                            <th>details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->status }}</td>
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
                                                    <strong>ref_code: </strong> <small>{{ $order->ref_code }}</small> <br>
                                                    <strong>date: </strong> {{ $order->created_at }} <br>
                                                    <hr>
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
                                                                    <td>{{ $item->product->name }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>{{ $item->total_price }}</td>
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
    </section>
@endsection
