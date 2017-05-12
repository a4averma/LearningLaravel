<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subscription;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $subs_normal = Subscription::where('name', 'normal')->first();
        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);
        if ($this->signIn($request)) {
            flash('Welcome back!');
            if(Auth::user()->hasSubscription('standard') || Auth::user()->hasSubscription('Premium')) {
                if(Carbon::now() > Auth::user()->subscription_end) {
                    Auth::user()->subscriptions()->detach();
                    Auth::user()->subscriptions()->attach($subs_normal);
                    return redirect()->intended('/subscription');
                }
                return redirect()->intended('/home');
            } else {
                return redirect()->intended('/subscription');
            }
        }
        flash('Unable to log you in. Please try again.');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        flash('You have now been signed out successfully.');
        return redirect('login');
    }

    protected function signIn(Request $request)
    {
        return Auth::attempt($this->getCredentials($request), $request->has('remember'));
    }

    protected function getCredentials(Request $request)
    {
        return [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'verify_status' => true
        ];
    }
}
