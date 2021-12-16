<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Levels;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $data = Levels::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    $url_update = route('admin::editQuestionLevel', ['id' => $data->id]);
                    $url_delete = "'".route('admin::deleteQuestionLevel', ['id' => $data->id])."'";
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
        return view('admin.levels.index');
    }

    public function add(){
        return view('admin.levels.add');
    }
    public function save(Request $request)
    {
        $msg = [
            'name.required' => 'Enter Subscription Name',
        ];
        $this->validate($request, [
            'name' => 'required',
        ], $msg);
        $data = $request->except('_token');
        Levels::create($data);
        return redirect()->back()->with('success','Question Level Added Successfully !!!');
    }
    public function edit($id){
        $info = Levels::where('id', $id)->first();
        return view('admin.levels.edit', compact('info'));
    }

    public function update(Request $request,$id)
    {
        $msg = [
            'name.required' => 'Enter Subscription Name',
        ];
        $this->validate($request, [
            'name' => 'required',
        ], $msg);
        $data = $request->except('_token');
        Levels::where('id',$id)->update($data);
        return redirect()->back()->with('success', 'Question Level Updated Successfully !!!');
    }

    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            Levels::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='<a class="btn btn-xs btn-danger" href="javascript:status('.$id.','.$st.');" title="Status">
                                             <i class="fas fa-ban"></i>
                                         </a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            Levels::where('id',$id)->update([
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
        Levels::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Question Level Deleted Successfully !!!');
    }
}
