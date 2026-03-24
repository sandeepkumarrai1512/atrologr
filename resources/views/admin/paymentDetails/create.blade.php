
@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

<div class="main-content">
@section('content')
</div>
<h2>Add Payment</h2>

<form method="POST" action="{{ route('admin.payment.store') }}">
    @csrf

    <input type="text" name="transaction_id" placeholder="Transaction ID"><br><br>

    <input type="number" name="user_id" placeholder="User ID"><br><br>

    <input type="number" step="0.01" name="amount" placeholder="Amount"><br><br>

    <select name="status">
        <option value="pending">Pending</option>
        <option value="success">Success</option>
        <option value="failed">Failed</option>
    </select><br><br>

    <button type="submit">Save</button>
</form>
