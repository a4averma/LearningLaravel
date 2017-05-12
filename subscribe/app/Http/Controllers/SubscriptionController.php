<?php

namespace App\Http\Controllers;

use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;
use App\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('subscription.plans');
    }

    public function pay(Request $request) {
        if($request['plan'] === "standard"){
            $purpose = "Standard Subscription";
            $amount = "3600.00";
        } else {
            $purpose = "Premium Subscription";
            $amount = "7200.00";
        }
        $parameters = [
            'purpose' => $purpose,
            'amount' => $amount,
            ];
        $order = Indipay::prepare($parameters);
        return Indipay::process($order);
    }

    public function getPay(Request $request) {

        $subs_normal = Subscription::where('name', 'normal')->first();
        $subs_standard = Subscription::where('name', 'standard')->first();
        $subs_premium = Subscription::where('name', 'premium')->first();

        $user = Auth::user();
        $response = Indipay::response($request);
        $details = $response->payment_request->payment;

        if($details->status === 'Credit') {
            if ($response->payment_request->purpose === "Standard Subscription") {
                $user->subscriptions()->detach($subs_normal);
                $user->subscriptions()->attach($subs_standard);
                Payment::create([
                    'user_id' => Auth::user()->id,
                    'amount' => $details->unit_price,
                    'buyer_name' => $details->buyer_name,
                    'buyer_email' => $details->buyer_email,
                    'buyer_number' => $details->buyer_phone,
                    'request_id' => $response->payment_request->id,
                    'payment_id' => $details->payment_id,
                    'status' => true,
                ]);


            } elseif($response->payment_request->purpose === "Premium Subscription") {

                $user->subscriptions()->detach($subs_normal);
                $user->subscriptions()->attach($subs_premium);

                Payment::create([
                    'user_id' => Auth::user()->id,
                    'amount' => $details->unit_price,
                    'buyer_name' => $details->buyer_name,
                    'buyer_email' => $details->buyer_email,
                    'buyer_number' => $details->buyer_phone,
                    'request_id' => $response->payment_request->id,
                    'payment_id' => $details->payment_id,
                    'status' => true,
                ]);
            }
            $user = Auth::user();
            $user->subscription_end = Carbon::now()->addYear(1);
            $user->save();
        }
        flash('success');
        return redirect('home');
    }
}