@extends('admin.layouts.app')

@section('title', 'Payments')

@section('content')
    <h1 class="text-center mt-2">Payments</h1>
    <div class="container mt-5">
        <div class="row">
            @include('admin.layouts.messages')
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>ref_id</th>
                        <th>res_id</th>
                        <th>status</th>
                        <th>order id</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->ref_id }}</td>
                            <td>{{ $payment->res_id }}</td>
                            <td>
                                @if ($payment->status == 'paid')
                                    <span class="badge bg-success">paid</span>
                                @else
                                    <span class="badge bg-danger">unpaid</span>
                                @endif
                            </td>
                            <td>{{ $payment->order_id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {!! $links !!}
            </div>
        </div>
    </div>
@endsection
