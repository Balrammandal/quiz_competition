<?php

namespace App\Http\Controllers\Admin;

use App\Coupons;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $data = Coupons::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    $url_update = route('admin::editCoupon', ['id' => $data->id]);
                    $url_delete = "'".route('admin::deleteCoupon', ['id' => $data->id])."'";
                    $edit='<span id="status_'.$data->id.'">';
                    if($data->status=='Active'){
                        $edit .='<a class="btn btn-xs btn-info"
                                            href="javascript:status('.$data->id.','.$data->status.');" title="Status">
                                             <i class="fas fa-check"></i>
                                         </a>';
                    } else{
                        $edit .='<a class="btn btn-xs btn-danger"
                                            href="javascript:status('.$data->id.','.$data->status.');" title="Status">
                                             <i class="fas fa-ban"></i>
                                         </a>';
                    }
                    $edit.='</span>&nbsp';
                    $edit .= '<a href="' . $url_update . '" class="btn btn-xs btn-primary fancybox fancybox.iframe" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a data-toggle="modal" data-target="#confirmDelete"  class="btn btn-xs btn-danger" title="Delete" onclick="getDeleteRoute(' . $url_delete . ')"> <i class="fas fa-trash"></i></a>';
                    return $edit;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.coupons.index');
    }

    public function add(){
        return view('admin.coupons.add');
    }
    public function save(Request $request)
    {
        $msg = [
            'coupon_code.required' => 'Enter coupon code.',
            'coupon_code.unique' => 'Coupon already exists.',
            'discount_type.required' => 'Select descount type.',
            'amount.required' => 'Enter amount.',
        ];
        $this->validate($request, [
            'coupon_code' => 'required|unique:coupons',
            'discount_type' => 'required',
            'amount' => 'required',
        ], $msg);
        $data = $request->except('_token');
        Coupons::create($data);
        return redirect()->back()->with('success','Coupon Added Successfully !!!');
    }
    public function edit($id){
        $info = Coupons::where('id', $id)->first();
        return view('admin.coupons.edit', compact('info'));
    }

    public function update(Request $request,$id)
    {
        $msg = [
            'coupon_code.required' => 'Enter coupon code.',
            'coupon_code.unique' => 'Coupon already exists.',
            'discount_type.required' => 'Select descount type.',
            'amount.required' => 'Enter amount.',
        ];
        $this->validate($request, [
            'coupon_code' => 'required|unique:coupons,id,'.$id,
            'discount_type' => 'required',
            'amount' => 'required',
        ], $msg);
        $data = $request->except('_token');
        Coupons::where('id',$id)->update($data);
        return redirect()->back()->with('success', 'Coupon Updated Successfully !!!');
    }

    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            Coupons::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='<a class="btn btn-xs btn-danger" href="javascript:status('.$id.','.$st.');" title="Status">
                                             <i class="fas fa-ban"></i>
                                         </a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            Coupons::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='<a class="btn btn-xs btn-info" href="javascript:status('.$id.','.$st.');" title="Status">
                                             <i class="fas fa-check"></i>
                                         </a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }

    public function delete($id)
    {
        Coupons::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Coupons Deleted Successfully !!!');
    }
}
