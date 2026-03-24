<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

 <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 12px 15px;
        border-radius: 5px;
        border: 1px solid #c3e6cb;
        margin-bottom: 15px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px 15px;
        border-radius: 5px;
        border: 1px solid #f5c6cb;
        margin-bottom: 15px;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 18px;
    }
</style>
<section class="Row3-Register-body">
    <div class="Row3-Register">
        <h2>Register Now</h2>
        <p class="register-subtitle">Business information</p>

        @if(session('success'))
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
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


        <form method="POST" action="{{ route('user.register') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <input type="text" class="form-control" placeholder="Full name *" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <input type="tel" class="form-control" placeholder="Phone number *" name="phone" value="{{ old('phone') }}" required>
                </div>
            </div>
            <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{ old('company_name') }}">
            </div>

            <div class="col-md-6 col-sm-12 col-xs-12">
                <input type="text" class="form-control" placeholder="GST number" name="gst_number" value="{{ old('gst_number') }}">
            </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" class="form-control" placeholder="Address" name="address" value="{{ old('address') }}">
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <input type="text" class="form-control" placeholder="State" name="state" value="{{ old('state') }}">
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <input type="text" class="form-control" placeholder="PIN Code" name="pin_code" value="{{ old('pin_code') }}">
                </div>
            </div>

            <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <input type="email" class="form-control" placeholder="Email address *" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="col-md-6 col-sm-12 col-xs-12 password-field position-relative">
                <input type="password" class="form-control" placeholder="Password *" id="passwordField" name="password" required>
                <button type="button" class="password-toggle position-absolute top-50 end-0 translate-middle-y me-3" 
                        onclick="togglePassword()" style="background: none; border: none;">
                    <svg id="eyeIcon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <!-- Open Eye by default -->
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="termsCheck" required>
                <label class="form-check-label" for="termsCheck">
                    I have read and accepted <a href="/image/Terms-and-Conditions.pdf" target="_blank">terms and policy</a> to get registered.
                </label>
            </div>

            <button type="submit" class="btn btn-submit">Submit</button>

            <div class="signin-link">
                Already registered? <a href="{{ route('login') }}">Click here to Sign in</a>
            </div>
        </form>
    </div>
</section>

<script>
function togglePassword() {
    const passwordField = document.getElementById('passwordField');
    const eyeIcon = document.getElementById('eyeIcon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        // Closed Eye Icon
        eyeIcon.innerHTML = '<path d="M17.94 17.94A10.06 10.06 0 0 1 12 20C5 20 1 12 1 12a18.45 18.45 0 0 1 5.11-5.11"/><path d="M22.54 11.88A18.44 18.44 0 0 1 19.79 15.8"/><line x1="2" y1="2" x2="22" y2="22" />';
    } else {
        passwordField.type = 'password';
        // Open Eye Icon
        eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3" />';
    }
}
</script>
