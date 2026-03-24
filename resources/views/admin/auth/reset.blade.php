<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.Row3-Login-body {
    background: linear-gradient(135deg, #e3e7f1 0%, #d1d8e8 100%);
    min-height: 100vh;
    display: flex
;
    align-items: center;
    justify-content: center;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
.Row3-Login {
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    padding: 30px 40px;
    width: 600px;
    /* height: 614px; */
    margin: 16px;
    display: flex
;
    flex-direction: column;
    justify-content: center;
}
.Row3-Login .form-control {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 14px 16px;
    font-size: 16px;
    transition: all 0.3s ease;
    background-color: #ffffff;
    margin-bottom: 10px;
    width: 100% !important;
}
.Row3-Login .btn-signin {
    background: linear-gradient(135deg, #1C75BC 0%, #155a94 100%);
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: 600;
    font-size: 16px;
    padding: 14px;
    width: 100%;
    margin-top: 16px;
    margin-bottom: 32px;
    transition: all 0.3s ease;
    cursor: pointer;
}
</style>

<section class="Row3-Login-body">
	<div class="Row3-Login">
		<h2>Reset Password</h2>
		<form method="POST" action="{{ route('admin.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            
            <div class="mb-3">
            <label>New Password:</label>
            <input class="form-control" type="password" name="password" required>
            </div>
            
            <div class="mb-3">
            <label>Confirm Password:</label>
            <input class="form-control" type="password" name="password_confirmation" required>
            </div>
        
            @error('password') <span>{{ $message }}</span> @enderror
        
            <button type="submit" class="btn-signin">Reset Password</button>
        </form>
	</div>
</section>
