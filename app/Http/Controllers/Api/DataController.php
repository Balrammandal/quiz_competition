<?php

namespace App\Http\Controllers\Api;

use App\Coupons;
use App\Http\Controllers\Controller;
use App\repo\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    public function getCoupons()
    {
        $data = Coupons::where("status", "Active")->get();
        $msg = "Coupons fetch successfully.";
        return Response::Success($data, $msg);
    }
    public function validateCoupon(Request $request)
    {
        $msg = [
            'coupon_code.required' => 'Enter coupon code.',
        ];
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required',
        ], $msg);
        if ($validator->passes()) {
            $data = Coupons::select(['id','coupon_code','discount_type','amount'])->where("coupon_code", $request->coupon_code)->first();
            if(!empty($data)){
                $msg = "Coupon validate successfully.";
                return Response::Success($data, $msg);
            }else{
                $msg = "Invalid coupon.";
                return Response::Error([], $msg);
            }   
        } else {
            $data = [];
            $msg = $validator->errors()->first();
            return Response::Error($data, $msg);
        }
    }
}
