<?php

namespace App\Http\Controllers\Admin;

use App\Countries;
use App\States;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $data = User::where('user_type','User')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('action', function ($data) {
                    $url_update = route('admin::editUser', ['id' => $data->id]);
                    $url_delete = "'".route('admin::deleteUser', ['id' => $data->id])."'";
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
        return view('admin.user.index');
    }

    public function add(){
        $countries = Countries::get();
        return view('admin.user.add',compact('countries'));
    }
    public function save(Request $request)
        {
           // dd($request->all());
            $msg = [
                'name.required' => 'Enter Name',
                'email.required' => 'Enter Email',
                'email.unique' => 'Email already exist.',
                'phone.required' => 'Enter Phone Number',
                'address.required' => 'Enter Address',
                'city.required' => 'Enter City',
                'country_id.required' => 'Select Country',
                'state_id.required' => 'Select State',
                'pin_code.required' => 'Enter Pin Code',
            ];
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|unique:users',
                'phone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country_id' => 'required',
                'state_id' => 'required',
                'zip_code' => 'required',
            ], $msg);
            $data = $request->except('_token');
            $data["password"] = bcrypt('123456');
            $data["user_type"] = "User";
            $data["api_token"] = Str::random(60);
            $user = User::create($data);
        //    $admin = new Role();
        //    $admin->name         = 'user';
        //    $admin->save();
           $user->assignRole(['user']);
            return redirect()->back()->with('success','User Added Successfully !!!');
    }
    public function edit($id){
        $userById = User::where('id', $id)->first();
        $countries = Countries::get();
        $states = States::where("country_id",$userById->country_id)->get();
        return view('admin.user.edit', compact('userById','countries','states'));
    }

    public function update(Request $request,$id)
    {
        $msg = [
            'name.required' => 'Enter Name',
            'email.required' => 'Enter Email',
            'email.unique' => 'Email already exist.',
            'phone.required' => 'Enter Phone Number',
            'address.required' => 'Enter Address',
            'city.required' => 'Enter City',
            'country_id.required' => 'Select Country',
            'state_id.required' => 'Select State',
            'pin_code.required' => 'Enter Pin Code',
        ];
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,id,'.$id,
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'zip_code' => 'required',
        ], $msg);
        $data = $request->except('_token');
        User::where('id',$id)->update($data);
        return redirect()->back()->with('success', 'User Updated Successfully !!!');
    }

    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            User::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='<a class="btn btn-xs btn-danger" href="javascript:status('.$id.','.$st.');" title="Status">
                                             <i class="fas fa-ban"></i>
                                         </a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            User::where('id',$id)->update([
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
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully !!!');
    }
}
