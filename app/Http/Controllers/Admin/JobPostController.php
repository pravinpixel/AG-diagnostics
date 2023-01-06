<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Admin\JobPost;
use App\Models\Admin\Country;
use App\Models\Admin\Department;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Yajra\DataTables\Facades\DataTables;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.job-post') || $user->hasAccess('user.add.job-post') )
        {
        if ($request->ajax()) {
            $data = JobPost::with('city')
            ->leftJoin('departments','departments.id','=','job_posts.department_id')
            ->select('job_posts.*','departments.name as department_name')->orderBy('created_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    if($user->hasAccess('user.edit.job-post'))
                    $edit=button('edit',route('job-post.edit', $data->id));

                    if($user->hasAccess('user.delete.job-post'))
                    $delete = button('delete',route('job-post.delete', $data->id));

                    return $edit.$delete;

                })
                ->editColumn('department_name', function ($data) {
                    if($data->department_name == "")
                    {
                        return $department_name = "";
                    }
                   else{
                    return $department_name = $data->department_name;
                   }
                })
                
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
                ->addColumn('status', function($data) {
                    return toggleButton('status',route('job-post.status', $data->id),$data);
                 })
                ->rawColumns(['action', 'status', 'download'])
                ->make(true);
        }
        return view('admin.manage_career.job.index');
        }
        else{
            if($user->hasAccess('user.view.careers'))
            {
                return redirect()->route('admin_careers.index');
            }
            else if($user->hasAccess('user.view.department')){
                return redirect()->route('department.index');
            }
            else{
                Flash::error( __('action.permission'));
                return redirect()->route('admin.dashboard');
            }
        }

    }
    public function create()
    {
        $city =City::get()->pluck('city', 'cityId');
        $department =Department::where('status',1)->get()->pluck('name','id');
        return view('admin.manage_career.job.create',compact('department','city'));
        
    }
    public function store(Request $request,$id=null)
    {
        $this->validate($request, [
            
            'job_title' => 'required|unique:job_posts,job_title,'. $id.',id,deleted_at,NULL',
        ]);
        if($id)
        {
            $data = JobPost::where('id',$id)->first();
            $data->job_title = $request->job_title;
            $data->cityId = $request->cityId;
            $data->department_id = $request->department_id;
            $data->experience = $request->experience;
            $data->education = $request->education;
            $data->job_purpose = $request->job_purpose;
            $data->responsibilities = $request->responsibilities;
            $data->posts = $request->posts;
            $data->status = $request->status;
            $res =  $data->update();
           
        }
        else{
            $data = new JobPost;
            $data->job_title = $request->job_title;
            $data->cityId = $request->cityId;
            $data->department_id = $request->department_id;
            $data->experience = $request->experience;
            $data->education = $request->education;
            $data->job_purpose = $request->job_purpose;
            $data->responsibilities = $request->responsibilities;
            $data->posts = $request->posts;
            $data->status = $request->status;
            $res =  $data->save();
        }
        if($data->save())
        {
         Flash::success( __('action.saved', ['type' => 'Job Post']));
        }
        return redirect()->route('job-post.index');
    }
    public function edit($id)
    {
        $city =City::get()->pluck('city', 'cityId');
        $job = JobPost::find($id);
        $department =Department::where('status',1)->get()->pluck('name','id');
       
        return view('admin.manage_career.job.edit',compact('job','department','city'));
    }
    public function delete($id = null)
    {
        $job  = JobPost::find($id);
        $job->delete();
        Flash::success(__('action.deleted', ['type' => 'Job Post']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $city  = JobPost::find($request->id);
        if($request->val == 1)
        {
            $city->status = 0;
            $city->save();
        }
        else{
            $city->status = 1;
            $city->save();
        }
        Flash::success( __('action.status', ['type' => 'Job Post']));

    }
}
