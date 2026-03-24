@extends('admin.layouts.master')

@section('title', 'View User')

@section('content')
<div class="Admin-Dashboard-main">
<div class="container py-4">
    <h2 class="seller-product-header mb-3">User Details</h2>
    <div class="card shadow-sm">
        <div class="card-header  text-white">
            <div class="adminProductViewBack"><a href="/admin/users"><button class="btn btn-primary">Back</button></a></div>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9">{{ $user->name }}</dd>

                <dt class="col-sm-3">Phone</dt>
                <dd class="col-sm-9">{{ $user->phone }}</dd>

                <dt class="col-sm-3">Company Name</dt>
                <dd class="col-sm-9">{{ $user->company_name ?? 'N/A' }}</dd>

                <dt class="col-sm-3">GST Number</dt>
                <dd class="col-sm-9">{{ $user->gst_number ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Address</dt>
                <dd class="col-sm-9">{{ $user->address ?? 'N/A' }}</dd>

                <dt class="col-sm-3">State</dt>
                <dd class="col-sm-9">{{ $user->state ?? 'N/A' }}</dd>

                <dt class="col-sm-3">PIN Code</dt>
                <dd class="col-sm-9">{{ $user->pin_code ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    @if($user->status === 'active')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Deactive</span>
                    @endif
                </dd>
            </dl>
        </div>
    </div>
</div>
</div>
@endsection
