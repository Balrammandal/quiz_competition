<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserSubscriptions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserSubscriptionController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $data = UserSubscriptions::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('subscription_name', function ($data) {
                    return $data->subscription->name;
                })
                ->addColumn('action', function ($data) {
                    $url_update = route('admin::UserSubscriptionDetail', ['id' => $data->id]);
                    $edit = '<a href="' . $url_update . '" class="btn btn-xs btn-primary fancybox fancybox.iframe" title="Info"><i class="fas fa-eye"></i></a>';
                    return $edit;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.user_subscription.index');
    }
    public function details($id){
        $info = UserSubscriptions::where('id', $id)->first();
        return view('admin.user_subscription.details', compact('info'));
    }


}
