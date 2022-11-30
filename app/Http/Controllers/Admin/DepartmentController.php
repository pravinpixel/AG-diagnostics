<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Admin\Department;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUSer();
        if($user->hasAccess('user.view.department') || $user->hasAccess('user.add.department'))
        {
            if ($request->ajax()) {
                $data = Department::select('*');
                return DataTables::eloquent($data)
                    ->addIndexColumn()
    
                    ->addColumn('action', function ($data) {
                        $user = Sentinel::getUser();
                        $edit = '';
                        $delete = '';
                        if($user->hasAccess('user.edit.department'))
                        $edit=button('edit',route('department.edit', $data->id));
    
                        if($user->hasAccess('user.delete.department'))
                        $delete = button('delete',route('department.delete', $data->id));

                        return $edit.$delete;
                    })
                    ->addColumn('created_at', function ($data) {
                        return date('d M Y', strtotime($data['created_at']));
                    })
                    ->addColumn('status', function($data) {
                        return toggleButton('status',route('department.status', $data->id),$data);
                     })
                    ->rawColumns(['action', 'status', 'download'])
                    ->make(true);
            }
            return view('admin.manage_career.department.index');
        }
        else{
            if($user->hasAccess('user.view.careers'))
            {
                return redirect()->route('admin_careers.index');
            }
            else if($user->hasAccess('user.view.job-post'))
            {
                return redirect()->route('job-post.index');
            }
            else{
                Flash::error( __('action.permission'));
                return redirect()->route('admin.dashboard');
            }
        }

    }
    public function create()
    {
        return view('admin.manage_career.department.create');
        
    }
    public function store(Request $request,$id=null)
    {
        $this->validate($request, [
            
            'name' => 'required|unique:departments,name,'. $id.',id,deleted_at,NULL',
        ]);
        if($id)
        {
            $data = Department::where('id',$id)->first();
            $data->name = $request->name;
            $data->status = $request->status;
            $res =  $data->update();
           
        }
        else{
            $data = new Department;
            $data->name = $request->name;
            $data->status = $request->status;
            $res =  $data->save();
        }
        if($data->save())
        {
         Flash::success( __('action.saved', ['type' => 'Department']));
        }
        return redirect()->route('department.index');
    }
    public function edit($id)
    {

        $department = Department::find($id);
       
        return view('admin.manage_career.department.edit',compact('department'));
    }
    public function delete($id = null)
    {
        $department  = Department::find($id);
        $department->delete();
        Flash::success(__('action.deleted', ['type' => 'Department']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $data  = Department::find($request->id);
        if($request->val == 1)
        {
            $data->status = 0;
            $data->save();
        }
        else{
            $data->status = 1;
            $data->save();
        }
        Flash::success( __('action.status', ['type' => 'Department']));

    }
}
