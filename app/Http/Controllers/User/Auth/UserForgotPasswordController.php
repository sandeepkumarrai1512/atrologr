<?php
namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class UserForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('user.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );
    
        if ($status === Password::RESET_LINK_SENT) {
            $homeLink = url('/');
            $message = __($status) . ' <a href="' . $homeLink . '">Click here to continue browsing</a>';
            return back()->with('status', $message);
        }
    
        return back()->withErrors(['email' => __($status)]);
    }

}
