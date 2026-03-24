<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
a.returntologinbtn {
    position: relative;
    text-align: end;
    display: flex;
    justify-content: end;
    font-size: 15px;
    margin-top: 0;
    color: #1b70b5;
    font-weight: 500;
    text-decoration: underline !important;
}
</style>
<section class="Row3-Login-body">
    <div class="Row3-Login">
        <h2 class="pb-3">Forgot your password?</h2>

        {{-- Success message --}}
        @if(session('status'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px 15px; border-radius: 4px; border: 1px solid #c3e6cb; margin-bottom: 15px; margin-top:10px;">
                {!! session('status') !!}
            </div>
        @endif

        {{-- Error message --}}
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px 15px; border-radius: 4px; border: 1px solid #f5c6cb; margin-bottom: 15px; margin-top:10px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" style="margin-top:20px;">
            @csrf
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
            </div>

            <button type="submit" class="btn btn-signin">Send Reset Link</button>
            <a href = "/login" class = "returntologinbtn">Return To Login</a>
        </form>
    </div>
</section>