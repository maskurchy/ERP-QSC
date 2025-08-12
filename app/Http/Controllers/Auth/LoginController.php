<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SystemSetting;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $centerName = SystemSetting::get('center_name', 'রুকইয়াহ সেন্টার');
        $centerLogo = SystemSetting::get('center_logo');
        
        return view('auth.login', compact('centerName', 'centerLogo'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Check if user is active
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'আপনার অ্যাকাউন্টটি নিষ্ক্রিয় করা হয়েছে।',
                ]);
            }

            // Redirect based on user type
            return $this->redirectBasedOnUserType($user);
        }

        return back()->withErrors([
            'email' => 'প্রদত্ত তথ্য আমাদের রেকর্ডের সাথে মিলছে না।',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }

    private function redirectBasedOnUserType($user)
    {
        switch ($user->user_type) {
            case 'super_admin':
            case 'admin':
                return redirect()->intended('/admin/dashboard');
            case 'doctor':
                return redirect()->intended('/doctor/dashboard');
            case 'receptionist':
                return redirect()->intended('/reception/dashboard');
            case 'patient':
                return redirect()->intended('/patient/dashboard');
            default:
                return redirect()->intended('/dashboard');
        }
    }
}
