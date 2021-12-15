<?php

namespace App\Http\Controllers\Frontend;
use App\States;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function getState(Request $request){
        $states = States::where("country_id",$request->country_id)->where('status','Active')->get();
        $html = '<option value="">Select State</option>';
        foreach ($states as $state) {
            $html.="<option value=".$state->id.">".$state->name."</option>";
        }
        return $html;
    }
}
