<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JobPost;
use Illuminate\Http\Request;
use App\Models\Website\Careers;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class CareersController extends Controller
{
    public function index(Request $request)
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
