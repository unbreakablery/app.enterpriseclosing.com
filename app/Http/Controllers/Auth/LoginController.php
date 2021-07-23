<?php

namespace App\Http\Controllers\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated()
    {
        if (Auth::user()->role == 0 || !Auth::User()->active) {
            if (Auth::user()->role == 0) {
                $message = 'Your account was deleted already, please re-signup or contact support.';
                $message .= ' And then your all data will be recovered.';
            } else {
                $message = 'Account not activate, please try again later or contact support.';
            }

            Auth::logout();

            return redirect()->back()
                            ->withErrors([
                                'role-inactive' => $message
                            ])
                            ->withInput();
        }
    }
}
