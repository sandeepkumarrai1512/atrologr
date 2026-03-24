<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FrontUserController extends Controller
{
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:30',
            'phone' => 'required|numeric|digits_between:10,13',
            'company_name' => 'nullable|string|max:50',
            'gst_number' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:60',
            'state' => 'nullable|string|max:40',
            'pin_code' => 'nullable|string|max:10',
            'email' => 'required|email:rfc,dns|min:5|max:50|unique:users,email',
            'password' => 'required|min:6|max:20',
        ]);

        $user = new User();
        $user->fill($validated);
        $user->password = Hash::make($validated['password']);
        $user->status = 'deactive';
        $user->save();
        
        DB::table('notification')->insert([
            'userid'        => 0,
            'page_name'     => 'User Registration',
            'notification'  => 'A new user has registered: ' . $user->name,
            'url'           => '/admin/users/'.$user->id.'/edit',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
        
        $to = $user->email;
        $subject = "Registration Successful - Awaiting Approval";
        $loginUrl = route('login');
        
        $message = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Registration Confirmation</title>
        </head>
        <body style='font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;'>
            <div style='max-width: 600px; margin: auto; background: #ffffff; border-radius: 8px; padding: 20px; border: 1px solid #e0e0e0;'>
              
                <h2 style='color: #28a745; text-align: center;'>🎉 Registration Successful!</h2>
                <p style='font-size: 15px; color: #333333; line-height: 1.6;'>
                    Hello <strong>" . htmlspecialchars($user->name) . "</strong>,<br><br>
                    Thank you for registering on our website. Your account has been created and is now <strong>pending admin approval</strong>.<br><br>
                    Once approved, you can log in using the button below.
                </p>
                <div style='text-align: center; margin: 20px 0;'>
                    <a href='" . $loginUrl . "' style='background-color: #28a745; color: #ffffff; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>
                        🔑 Login to Your Account
                    </a>
                </div>
            </div>
        </body>
        </html>
        ";
        
        $headers = "From: no-reply@mlno.in\r\n" .
                   "Reply-To: no-reply@mlno.in\r\n" .
                   "MIME-Version: 1.0\r\n" .
                   "Content-Type: text/html; charset=UTF-8\r\n" .
                   "X-Mailer: PHP/" . phpversion();
        
        @mail($to, $subject, $message, $headers);


        return back()->with('success', 'Registered successfully. Please wait for admin approval. After approval you can <a href="'.route('login').'">Login from here</a>');

    }

    public function showLoginForm(Request $request)
    {
        
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
    
        if ($request->query('logout') === 'true') {
            return redirect()->route('login');
        }
    
        return view('user.auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        if ($user->status !== 'active') {
            return back()->withErrors(['email' => 'Your account is not activated yet.']);
        }

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}