@extends('admin.layouts.master')

@section('title', 'Edit User')

@section('content')
<div class="Admin-Dashboard-main">
<div class="container py-4">
    <h2 class="seller-product-header mb-3">Edit User</h2>
    <div class="card">
        <div class="card-header  text-white">
            <div class="adminProductViewBack"><a href="/admin/users"><button class="btn btn-primary">Back</button></a></div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some problems with your input:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Company Name</label>
                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $user->company_name) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>GST Number</label>
                        <input type="text" name="gst_number" class="form-control" value="{{ old('gst_number', $user->gst_number) }}">
                    </div>
                    <div class="col-md-6">
                        <label>State</label>
                        <input type="text" name="state" class="form-control" value="{{ old('state', $user->state) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>PIN Code</label>
                        <input type="text" name="pin_code" class="form-control" value="{{ old('pin_code', $user->pin_code) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="deactive" {{ $user->status === 'deactive' ? 'selected' : '' }}>Deactive</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
                </div>

                {{-- 🔒 Password Fields --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>New Password <small class="text-muted">(Leave blank to keep unchanged)</small></label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection