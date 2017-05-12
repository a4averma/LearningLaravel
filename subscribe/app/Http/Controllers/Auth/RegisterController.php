<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mailers\AppMailer;
use App\Subscription;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request, AppMailer $mailer)
    {
        $this->validator($request->all())->validate();
        $subs_normal = Subscription::where('name', 'normal')->first();
        $user = $this->create($request->all());
        $mailer->sendEmailConfirmation($user);
        $user->subscriptions()->attach($subs_normal);
        flash('Please Confirm your Email Address');
        return redirect()->back();
    }

    public function confirmRegistration($token)
    {
        $user = User::whereVerifyToken($token)->firstOrFail();
        $user->verify_status = true;
        $user->verify_token = null;
        $user->save();
        $message = "Your email has been confirmed. Please login";
        flash($message);
        return redirect('login');
    }
}
