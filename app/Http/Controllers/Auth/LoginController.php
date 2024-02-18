<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function username()
    {
        return 'username';
    }
   
    public function authenticated(){
        $user = \Auth::user();
        if(\Auth::check()){
            if ($user->isAdmin()) {
                return redirect('/admin/home');
            }
            else if ($user->isUser()) {
                return redirect('/guru/home');
            }
            else if ($user->isPanitia()) {
                return redirect('/panitia/home');
            }
            else if ($user->isPerpus()) {
                return redirect('/perpus/home');
            }
            else if ($user->isPondok()) {
                return redirect('/pondok/home');
            }
            else if ($user->isPaper()) {
                return redirect('/paper/home');
            }
            else if ($user->isSiswa()) {
                return redirect('/siswa/home');
            }
            else if ($user->isKeamanan()) {
                return redirect('/keamanan/home');
            }
            else if ($user->isBp()) {
                return redirect('/bp/home');
            }
            else{
                return redirect()->route('/login');                
            }
        }
        else{
            return redirect()->route('/login');                
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
 
        $request->session()->flush();
 
        $request->session()->regenerate();
 
        return redirect('/login');
    }
}
