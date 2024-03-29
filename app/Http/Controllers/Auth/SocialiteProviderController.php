<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialiteProviderController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }
  
  
    //tambahkan script di bawah ini 
    public function handleGoogleCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->stateless()->user();
            $user           = User::where('email', $user_google->email)->first();
            // dd($user);

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if( $user != null ) {
                Auth::login($user, true);
                return redirect()->route('dashboard.index');
            } else {
                $create = User::Create([
                    'email'             => $user_google->email,
                    'username'          => 'user_' . $user_google->id,
                    'name'              => $user_google->name,
                    'password'          => Hash::make(Str::random(30))
                ]);

                $token = $user->createToken();

                DB::table('password_resets')->insert([
                    'email' => $user_google->email, 
                    'token' => $token, 
                    'created_at' => Carbon::now()
                ]);

                $create->accountCreatedNotification($create, $token);
                
                Auth::login($create, true);
                return redirect()->route('dashboard.index');
            }

        } catch (\Exception $e) {
            if(env('APP_ENV') == 'local') {
                dd($e);
            }
            return redirect()->route('auth.login')->with('error', $e->getMessage());
        }
    }
}
