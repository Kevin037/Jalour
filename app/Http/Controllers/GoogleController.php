<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Auth;
use Redirect;

class GoogleController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(){
        // $user = Socialite::driver('google')->stateless()->user();
        // $finduser = User::where('google_id',$user->id)->first();
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id',$user->id)->first();
            // dd($finduser);
            if($finduser){
                Auth::login($finduser);
                if ($finduser->role == '1') {
                    return redirect('/home-admin');
                }
                elseif($finduser->role == '2'){
                    return redirect()->intended(RouteServiceProvider::HOME);
                }
            }
            else{
                // dd($user->id);
                $role='2';
                $newUser = User::create([
                    'name' => $user->name,
                    'role' => $role,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => bcrypt('12345678'),
                    // 'gambar' => $user->avatar,
                ]);
                Auth::login($newUser);
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } catch (\Throwable $th) {
            throw $th; 
        }
    }

    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id',$user->id)->first();
            // dd($user);
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended(RouteServiceProvider::HOME);
            }
            else{
                // dd($user->id);
                $role='2';
                $newUser = User::create([
                    'name' => $user->name,
                    'role' => $role,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => bcrypt('12345678'),
                    // 'gambar' => $user->avatar,
                ]);
                Auth::login($newUser);
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } catch (\Throwable $th) {
            //throw $th; 
        }
    }
}
