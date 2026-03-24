@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

<div class="main-content">
@section('content')
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Payment List</h4>
            <a href="{{ route('admin.payment.create') }}" class="btn btn-primary btn-sm float-end">
                Add Payment
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Transaction ID</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->transaction_id }}</td>
                        <td>{{ $payment->user_id }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection