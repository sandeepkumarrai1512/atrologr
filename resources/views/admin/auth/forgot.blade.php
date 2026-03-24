<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<section class="Row3-Login-body">
    <div class="Row3-Login">
        <h2>Forgot Password</h2>
        <p class="login-subtitle">Forgot Password information</p>
        
        <form method="POST" action="{{ route('admin.password.email') }}">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @csrf
            <div class="mb-3">
                <input class="form-control" type="email" name="email" placeholder="Enter your Email" required>
                @error('email') <span>{{ $message }}</span> @enderror
            </div>
            <button class="btn btn-signin" type="submit">Send Reset Link</button>
        </form>

    </div>
</section>