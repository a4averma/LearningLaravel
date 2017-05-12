<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasSubscription('standard')) {
            flash('Your Subscription is Standard');
        } elseif(Auth::user()->hasSubscription('Premium')) {
            flash('Your Subscription is Premium');
        } else {
            flash('You have none.');
        }
        return view('home');
    }
}
