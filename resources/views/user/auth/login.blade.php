<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	.alert.alert-danger {
    background-color: #f8d7da;
    color: #842029;
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 15px;
    border: 1px solid #f5c2c7;
    text-align: center;
	}
	
	.alert.alert-danger ul li{
	list-style: none;
	}
	
</style>
<section class="Row3-Login-body">
	<div class="Row3-Login">
		<h2>Sign in</h2>
		<p class="login-subtitle">Login information</p>
		
		<form method="POST" action="{{ route('user.login') }}">
			
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul class="mb-0">
					@foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			
			@if(session('status'))
                <div class="alert alert-success">
                   <strong> {{ session('status') }} </strong>
                </div>
            @endif 
            
			@csrf
			<div class="mb-3">
				<input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Username or email address" required>
			</div>
			
			<div class="mb-3 password-field">
				<input type="password" class="form-control" placeholder="Password" name="password" id="passwordField" required>
				<button type="button" class="password-toggle" onclick="togglePassword()">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
					stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
						<circle cx="12" cy="12" r="3" />
					</svg>
				</button>
			</div>
			
			<div class="d-flex justify-content-between align-items-center mb-4">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="keepLoggedIn" name="remember">
					<label class="form-check-label" for="keepLoggedIn">
						Keep me logged in
					</label>
				</div>
				<a href="{{route('password.request')}}" class="forgot-password">Forgot password</a>
			</div>
			
			<button type="submit" class="btn btn-signin">Sign in</button>
			
			<div class="register-link">
				New user? <a href="{{ route('user.register.form') }}">Click Here to Register Now!</a>
			</div>
		</form>
	</div>
</section>

<script>
	function togglePassword() {
		const passwordField = document.getElementById('passwordField');
		const toggleButton = document.querySelector('.password-toggle svg');
		
		if (passwordField.type === 'password') {
			passwordField.type = 'text';
			toggleButton.innerHTML = `
			<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94L17.94 17.94z"/>
			<path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19l-6.93-6.93a2.97 2.97 0 0 0-4.15 4.15l-2.76-2.76z"/>
			<line x1="1" y1="1" x2="23" y2="23"/>
			`;
            } else {
			passwordField.type = 'password';
			toggleButton.innerHTML = `
			<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
			<circle cx="12" cy="12" r="3"/>
			`;
		}
	}
</script>