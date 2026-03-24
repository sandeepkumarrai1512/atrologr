<?php
	namespace App\Http\Controllers\Admin\Auth;
	
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	
	class LoginController extends Controller
	{
		public function showLoginForm()
		{
			if (Auth::guard('admin')->check()){
				return redirect()->route('admin.dashboard');
			}
			return view('admin.auth.login');
		}
		
		public function login(Request $request)
		{
			$request->validate([
            'email' => 'required|email',
            'password' => 'required',
			]);
			
			$remember = $request->has('remember');
			
			if (Auth::guard('admin')->attempt($request->only('email', 'password'), $remember)) {
				//  return redirect()->intended(route('admin.dashboard'));
				return redirect()->route('admin.dashboard');
			}
			
			return back()->withErrors(['email' => 'Invalid credentials']);
		}
		
		public function logout(Request $request)
		{
			Auth::guard('admin')->logout();
			$request->session()->invalidate();
			$request->session()->regenerateToken();
			
			return redirect()->route('admin.login');
		}
		
	}