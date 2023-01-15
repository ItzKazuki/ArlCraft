<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            "password" => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($data, $remember_me)) {
            $request->session()->regenerate();
 
            return redirect()->route('dashboard.index');
        }

        return back()->with('error', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('home');
    }
}
