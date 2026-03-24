@extends('user.layouts.master')

@section('title', 'Account Settings')

@section('content')
<!-- Main Content -->
<style>
.alert.alert-success {
    color: white;
}
</style>
<div class="Admin-Dashboard-main">
    <div class="Account-Setting-container">
        <h2 class="seller-product-header mb-3">My Profile</h2>
        @if (session('success'))
		<div class="alert alert-success">{{ session('success') }}</div>
        @endif
		
        @if ($errors->any())
		<div class="alert alert-danger">
			<ul class="mb-0">
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
        @endif
		
        <!-- Nav tabs -->
        <div class="profile-page-tabs">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#profile-tab">Profile</a>
			</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#bank-tab">Bank Details</a>
			</li>
		</ul>
		</div>
		
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Profile Tab -->
            <div class="tab-pane fade show active" id="profile-tab">
                <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
					
                    <div class="row">
                        <div class="col-lg-4 col-md-5 d-none">
                            <div class="text-center mx-auto" style="max-width: 400px;">
                                <h4 class="mb-4">Update Profile Photo</h4>
								
                                <div class="photo-wrapper mb-3">
                                    <img class="account-photo" src="{{ asset($user->profile ?? 'image/default-user.png') }}" alt="Profile" />
								</div>
								
                                <input type="file" name="profile_photo" accept="image/*" class="form-control" />
							</div>
						</div>
						
                        <div class="col-lg-8 col-md-7">
                            <div class="Account-Setting-form-group">
                                <label class="Account-Setting-label">Full Name*</label>
                                <input type="text" class="Account-Setting-input" name="name" value="{{ old('name', $user->name) }}" readonly>
							</div>
							
                            <div class="Account-Setting-sectionTitle"><span class="underline-name"> Business information</span></div>
							
                            <div class="Account-Setting-form-group">
                                <label class="Account-Setting-label">Company Name</label>
                                <input type="text" class="Account-Setting-input" name="company-name" value="{{ old('company-name', $user->company_name) }}" readonly>
							</div>
							
                            <div class="row">
                                <div class="col-md-6 Account-Setting-form-group">
                                    <label class="Account-Setting-label">Phone *</label>
                                    <input type="text" name="phone-number" class="Account-Setting-input" value="{{ old('phone-number', $user->phone) }}" readonly>
								</div>
                                <div class="col-md-6 Account-Setting-form-group">
                                    <label class="Account-Setting-label">Email *</label>
                                    <input type="email" class="Account-Setting-input" name="email" value="{{ old('email', $user->email) }}" readonly>
								</div>
							</div>
							
                            <div class="row">
                                <div class="col-md-6 Account-Setting-form-group">
                                    <label class="Account-Setting-label">Address</label>
                                    <input type="text" class="Account-Setting-input" name="address" value="{{ old('address', $user->address) }}" readonly>
								</div>
                                <div class="col-md-6 Account-Setting-form-group">
                                    <label class="Account-Setting-label">PIN Code</label>
                                    <input type="text" class="Account-Setting-input" name="pincode" value="{{ old('pincode', $user->pin_code) }}" readonly>
								</div>
							</div>
							
                            <div class="row">
                                <div class="col-md-6 Account-Setting-form-group">
                                    <label class="Account-Setting-label">State</label>
                                    <input type="text" class="Account-Setting-input" name="state" value="{{ old('state', $user->state) }}" readonly>
								</div>
							</div>
							
                            <div class="Account-Setting-form-group">
                                <label class="Account-Setting-label">GST Number</label>
                                <input type="text" class="Account-Setting-input" name="gst-number" value="{{ old('gst-number', $user->gst_number) }}" readonly>
							</div>
							
                            <div class="Account-Setting-button-group d-none">
                                <button type="submit" class="Account-Setting-btn-primary">Update</button>
                                <button type="button" class="Account-Setting-btn-secondary">Cancel</button>
							</div>
							
                            <div class="Account-Setting-sectionTitle"><span class="underline-name"> Change Password </span></div>
							
                            <div class="row">
                                <!--div class="col-md-4 Account-Setting-form-group">
                                        <label class="Account-Setting-label">Old Password</label>
                                        <input type="password" class="Account-Setting-input" name="old-password">
								</div-->
								
                                <div class="col-md-4 Account-Setting-form-group">
                                    <label class="Account-Setting-label">New Password</label>
                                    <input type="password" class="Account-Setting-input" name="new-password">
								</div>
                                <div class="col-md-4 Account-Setting-form-group">
                                    <label class="Account-Setting-label">Confirm New Password</label>
                                    <input type="password" class="Account-Setting-input" name="new-password_confirmation">
								</div>
							</div>
							
                            <div class="Account-Setting-button-group">
                                <button type="submit" class="Account-Setting-btn-primary">Update Password</button>
                                <a href="/user-dashboard" class="Account-Setting-btn-secondary">Back to dashboard</a>
							</div>
						</div>
					</div>
				</form>
			</div>
			
            <!-- Bank Details Tab -->
            <div class="tab-pane fade" id="bank-tab">
				<form action="{{ route('user.saveBankDetails') }}" method="POST" enctype="multipart/form-data">
					@csrf
					
					<div class="row">
					    <div class="col-lg-6 col-sm-6 col-xs-12">
					        <div class="Account-Setting-form-group">
						<label class="Account-Setting-label">Bank Name*</label>
						<input type="text" name="bank_name" class="Account-Setting-input"
						value="{{ old('bank_name', $bankDetails->bank_name ?? '') }}">
					</div>
					    </div>
					    
					    <div class="col-lg-6 col-sm-6 col-xs-12">
					        <div class="Account-Setting-form-group">
						<label class="Account-Setting-label">Account Name*</label>
						<input type="text" name="account_name" class="Account-Setting-input"
						value="{{ old('account_name', $bankDetails->account_name ?? '') }}">
					</div>
					    </div>
					    
					    <div class="col-lg-6 col-sm-6 col-xs-12">
					        	<div class="Account-Setting-form-group">
						<label class="Account-Setting-label">Account Number*</label>
						<input type="text" name="account_number" class="Account-Setting-input"
						value="{{ old('account_number', $bankDetails->account_number ?? '') }}">
					</div>
					    </div>
					    
					    <div class="col-lg-6 col-sm-6 col-xs-12">
					        <div class="Account-Setting-form-group">
						<label class="Account-Setting-label">IFSC Code*</label>
						<input type="text" name="ifsc_code" class="Account-Setting-input"
						value="{{ old('ifsc_code', $bankDetails->ifsc_code ?? '') }}">
					</div>
					    </div>
					    
					    <div class="col-lg-6 col-sm-6 col-xs-12">
					        <div class="Account-Setting-form-group">
						<label class="Account-Setting-label">QR Image</label>
						<input type="file" name="qr_image" class="Account-Setting-input">
						@if (!empty($bankDetails->qr_image))
						<img src="{{ asset($bankDetails->qr_image) }}" alt="QR Image" style="max-width:150px; margin-top:10px;">
						@endif
					</div>
					    </div>
					    
					</div>

					
					<div class="Account-Setting-button-group">
						<button type="submit" class="Account-Setting-btn-primary">Save Bank Details</button>
					</div>
				</form>
				 @if(!empty($logs) && count($logs))
    <h4 class="mb-4 mt-5">Logs</h4>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>IP Address</th>
                <th>Date</th>
                <th>Changes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
               @if($log->log_type === 'Seller Bank Details') 
                @php
                    $contentArray = json_decode($log->content, true);
                    $changes = '';
                    foreach ($contentArray as $field => $change) {
                        if ($change['new'] === 'Image updated') {
                            $changes .= "<strong>$field</strong>: Image updated<br>";
                        } else {
                            $old = $change['old'] ?? '';
                            $new = $change['new'] ?? '';
                            $oldFormatted = $old === '' ? "''" : "<strong>" . e($old) . "</strong>";
                            $newFormatted = $new === '' ? "''" : "<strong>" . e($new) . "</strong>";
                            $changes .= "Changed <strong>" . e($field) . "</strong> from " . $oldFormatted . " to " . $newFormatted . "<br>";
                        }
                    }
                @endphp
              <tr>
    <td>{{ $log->user->name ?? 'N/A' }}</td>
    <td>{{ $log->ip }}</td>
    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y h:iA') }}</td>
    <td>{!! $changes !!}</td>
</tr>@endif
            @endforeach
        </tbody>
    </table>
@endif
		</div>
	</div>
</div>
@endsection
			</div>
			
