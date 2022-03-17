<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon; 
use App\Models\User; 
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ResetPasswordNotification;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forget', [
            'title' => 'Reset Password'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $user = User::where('email', $request->email)->first();
 
        $token = $user->createToken();
 
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        $user->sendPasswordResetNotification($token);
 
        return redirect()->route('login')->with('success', 'We have e-mailed your password reset link!');
    }

    public function reset($token, Request $request)
    {
        return view('auth.reset', [
            'title' => 'Reset Password',
            'token' => $token,
            'email' => urldecode($request->email)
        ]);
    }

    public function resetStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:new_password'
        ]);
 
        $updatePassword = DB::table('password_resets')
                            ->where('email', $request->email)->where('token', $request->token)
                            ->first();
 
        if (!$updatePassword) {
            return redirect()->route('login')->with('error', 'Invalid token!');
        }
 
        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->new_password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();
 
        return redirect()->route('login')->with('success', 'Your password has been changed!');
    }
}
