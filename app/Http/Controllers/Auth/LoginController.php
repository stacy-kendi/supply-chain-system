<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('suppliers')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
        {
            return redirect()->intended('/supplierdashboard');
        }elseif(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
        {
            return redirect()->intended('/home');
        }else{
            return redirect()->intended('/home');
        }
    }

    public function redirectTo()
    {

        if (Auth::guard('web')->user()) {
        return "/home1";
        } elseif (Auth::guard('suppliers')->user()) {
        return "/supplierdashboard";
        }
        else {
        return "/home";
        }
    }
    
    public function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        // if(Auth::guard('web')->user())
        // {
        // return $this->authenticated($request, $this->guard('web')->user())
        // ?: redirect()->intended($this->redirectPath());
        // }
        // elseif(Auth::guard('suppliers')->user())
        // {
        // return $this->authenticated($request, $this->guard('suppliers')->user())
        // ?: redirect()->intended($this->redirectPath());
        // }
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('suppliers')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            dd($request->email);
            return redirect()->intended('/supplierdashboard');
        }

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            
            return redirect()->intended('/home1');
        }
    }

    public function logout(Request $request)
    {

        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:suppliers')->except('logout');

    }
}
