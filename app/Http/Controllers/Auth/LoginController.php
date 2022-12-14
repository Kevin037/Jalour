<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Auth;
use Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $intended = '/home-user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // session(['url.intended' => url()->previous()]);
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $input = $request-> all();
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);
    if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))){
        if(auth()->user()->role == 1){
            return redirect('/home-admin');
        }elseif(auth()->user()->role == 2){
            return redirect()->intended($this->redirectPath());
            // redirect()->intended(RouteServiceProvider::HOME);
        }
    }
    else{
        return back()->with('loginError', 'Login Gagal');
    }
    }
}
