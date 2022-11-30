<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JobPost;
use Illuminate\Http\Request;
use App\Models\Website\Careers;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class CareersController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.careers'))
        {
        if ($request->ajax()) {
            $data = Careers::with('job')->select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('download', function ($data) {
                    return '<a href="' . url('/') . '/website/upload/careers/' . $data['file'] . '" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Download" download> 
                    <i class="bi bi-download"></i>
                    </a>';
                })
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $delete = '';

                    if($user->hasAccess('user.delete.careers'))
                    $delete = button('delete', route('admin_careers.delete', $data->id));
                    $view = button('view', route('admin_careers.view', $data->id));
                    return $view.$delete;
                })
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
            
                ->rawColumns(['action', 'status', 'download'])
                ->make(true);
        }
        return view('admin.manage_career.careers.careers');
        }
        else{

            if($user->hasAccess('user.view.job-post')||$user->hasAccess('user.add.job-post'))
            {
                return redirect()->route('job-post.index');
            }
            else if($user->hasAccess('user.view.department')||$user->hasAccess('user.add.department')){
                return redirect()->route('department.index');
            }
            else{
                Flash::error( __('action.permission'));
                return redirect()->route('admin.dashboard');
            }
        }
    }
    public function delete($id = null)
    {
        $careers  = Careers::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Career']));
        return redirect()->back();
    }
    public function view($id)
    {
        $data = Careers::select('careers.*','job_posts.job_title')->where('careers.id',$id)->leftjoin('job_posts','job_posts.id','=','careers.job_id')->first();
        // dd($data);
        return view('admin.manage_career.careers.view',compact('data'));
    }
}
