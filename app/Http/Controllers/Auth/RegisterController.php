<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AccountCreated;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|alpha_dash|unique:users,username',
            'email' => 'required|email:dns|unique:users,email',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make(Str::random(30))
        ];

        $user = User::create($data);

        $token = $user->createToken();

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        $user->accountCreatedNotification($user, $token);

        return redirect()->route('login')->with('success', 'Email confrimation berhasil di kirim!');
    }
}
