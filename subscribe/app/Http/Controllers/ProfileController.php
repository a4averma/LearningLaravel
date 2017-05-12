<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasSubscription('standard')) {
            $subscription = 'standard';
        } elseif(Auth::user()->hasSubscription('premium')) {
            $subscription = 'Premium';
        }
        return view('profile.payments', ['subscription' => $subscription]);
    }
}
