<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    .alert {
	padding: 12px 18px;
	border-radius: 5px;
	margin-bottom: 18px;
	text-align: center;
	border: 1px solid transparent;
	font-size: 15px;
    }
    .alert-success { background-color: #d4edda; color: #155724; border-color: #c3e6cb; }
    .alert-danger { background-color: #f8d7da; color: #842029; border-color: #f5c2c7; }
    .alert-danger ul li { list-style: none; }
	
    .text-center {
	text-align: center;
    }
	
    .btn-signin {
	padding: 10px 20px;
	background: #0d6efd;
	color: white;
	border-radius: 4px;
	cursor: pointer;
	display: inline-block;
	text-decoration: none;
	border: none;
    }
    .btn-signin:hover {
	background: #0b5ed7;
    }
	
    .form-control {
	width: 100%;
	padding: 10px;
	border-radius: 4px;
	border: 1px solid #ccc;
    }
	
    .mb-3 {
	margin-bottom: 15px;
    }
</style>

<section class="Row3-Login-body">
    <div class="Row3-Login">
        <h2>Reset Password</h2>
		
        @if(isset($token_expired) && $token_expired)
		<div class="alert alert-danger">
			The password reset link has expired or is invalid.
		</div>
		
		<div class="text-center">
			<a href="{{ route('password.request') }}" class="btn btn-signin">
				Request New Link
			</a>
		</div>
        @else
		
		
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul style="margin: 0; padding-left: 0;">
				@foreach ($errors->all() as $error)
				@if (stripos($error, 'token') !== false)
				<li>The password reset link is invalid or has expired. Please request a new one.</li>
				@else
				<li>{{ $error }}</li>
				@endif
				@endforeach
			</ul>
		</div>
		@endif
		
		<form method="POST" action="{{ route('password.update') }}">
			@csrf
			<input type="hidden" name="token" value="{{ $token }}">
			<input type="hidden" name="email" value="{{ $email }}">
			<input type="text" class="form-control" value="{{ $email }}" readonly>
			
			<div class="mb-3">
				<input type="password" class="form-control" name="password" placeholder="New Password" required>
			</div>
			
			<div class="mb-3">
				<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
			</div>
			
			<button type="submit" class="btn btn-signin">Reset Password</button>
		</form>
        @endif
		
	</div>
</section>