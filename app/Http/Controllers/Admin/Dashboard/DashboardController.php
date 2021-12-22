<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\SubscriptionPlan;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        $user = User::where("user_type","User")->count();
        $teacher = User::where("user_type","Teacher")->count();
        $student = User::where("user_type","Students")->count();
        $other = User::where("user_type","Other")->count();
        $subscriptions = SubscriptionPlan::count();
        return view('admin.dashboard.index',compact("user","teacher","student","other","subscriptions"));
    }
}
