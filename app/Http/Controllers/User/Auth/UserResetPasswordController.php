<?php
	namespace App\Http\Controllers\User\Auth;
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Password;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Str;
	use Illuminate\Support\Facades\DB;
	use Carbon\Carbon;
	
	class UserResetPasswordController extends Controller
	{
		public function showResetForm(Request $request, $token)
		{
			$email = $request->query('email');
			$resetRecord = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();
			
			if (!$resetRecord) {
				return view('user.auth.reset-password', ['token_expired' => true]);
			}
			
			if (!Hash::check($token, $resetRecord->token)) {
				return view('user.auth.reset-password', ['token_expired' => true]);
			}
			
			if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
				DB::table('password_reset_tokens')->where('email', $email)->delete();
				return view('user.auth.reset-password', ['token_expired' => true]);
			}
			
			return view('user.auth.reset-password', [
            'token' => $token,
            'email' => $email,
            'token_expired' => false,
			]);
		}
		
		
		public function reset(Request $request)
		{
			$request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
			]);
			
			$status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
			
            function ($user, $password) {
                $user->forceFill([
				'password' => Hash::make($password),
				'remember_token' => Str::random(60),
                ])->save();
			}
			);
			
			return $status === Password::PASSWORD_RESET
            ? redirect()->route('user.login')->with('status', 'Your password has been changed. You can now log in with the new password.')
            : back()->withErrors(['email' => [__($status)]]);
		}
		
	}