<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $message = "You're not subscribed to any of our plans. Please subscribe to enjoy our services.";
        if ($request->user() === null) {
            return response()->view('subscription.plans', ['message' => $message]);
        }
        $actions = $request->route()->getAction();
        $subscriptions = isset($actions['subscriptions']) ? $actions['subscriptions'] : null;

        if($request->user()->hasAnySubscription($subscriptions) || !$subscriptions) {
            return $next($request);
        }
        return response()->view('subscription.plans', ['message' => $message]);
    }
}
