<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\repo\Response;
use App\UserSubscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function mySubscrption(){
        $data= UserSubscriptions::where("user_id",Auth::user()->id)->get();
        $msg = "Subscription fetch successfully.";
        return Response::Success($data, $msg);
    }
}
