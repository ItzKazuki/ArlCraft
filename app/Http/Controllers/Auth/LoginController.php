<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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

    //tambahkan script di bawah ini
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
  
  
    //tambahkan script di bawah ini 
    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if($user != null){
                Auth::login($user, true);
                return redirect()->route('dashboard.index');
            } else {
                $create = User::Create([
                    'email'             => $user_google->getEmail(),
                    'username'          => $user_google->getNickname(),
                    'name'              => $user_google->getName(),
                    'password'          => Hash::make(Str::random(30))
                ]);

                $token = $user->createToken();

                DB::table('password_resets')->insert([
                    'email' => $user_google->getEmail(), 
                    'token' => $token, 
                    'created_at' => Carbon::now()
                ]);

                $create->accountCreatedNotification($create, $token);
                
                Auth::login($create, true);
                return redirect()->route('dashboard.index');
            }

        } catch (\Exception $e) {
            return redirect()->route('login');
        }


    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
