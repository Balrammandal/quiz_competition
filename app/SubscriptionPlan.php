<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model 
{

    protected $table = 'subscription_plans';
    public $timestamps = true;
    public $guarded = [];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

}