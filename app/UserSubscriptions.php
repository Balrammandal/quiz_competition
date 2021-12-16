<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubscriptions extends Model 
{

    protected $table = 'users_subscriptions';
    public $timestamps = true;
    public $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function subscription()
    {
        return $this->belongsTo('App\SubscriptionPlan', 'subscription_id');
    }

}