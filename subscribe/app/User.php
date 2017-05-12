<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public static function boot() {
        parent::boot();

        static::creating(function($user){
            $user->verify_token = Str::random(30);
        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subscriptions() {
        return $this->belongsToMany('App\Subscription', 'user_subscriptions', 'user_id', 'subscription_id')->withTimestamps();
    }

    public function hasAnySubscription($subscriptions) {
        if (is_array($subscriptions)) {
            foreach($subscriptions as $subscription) {
                if($this->hasSubscription($subscription)) {
                    return true;
                }
            }
        } else {
            if($this->hasSubscription($subscriptions)) {
                return true;
            }
        }
        return false;
    }
    public function hasSubscription($subscription) {
        if($this->subscriptions()->where('name', $subscription)->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}
