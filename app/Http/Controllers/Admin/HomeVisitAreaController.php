<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeVisitArea;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class HomeVisitAreaController extends Controller
{
    public function index(Request $request)
    {
        // dd("s");
        if($request->ajax()) {
            $data = HomeVisitArea::select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()   
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $delete = '';
                    if($user->hasAccess('user.delete.home_visit_area'))
                    $delete = button('delete',route('home-visit-area.delete', $data->id));

                    return $delete;
                })
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('home-visit-area.status', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.manage_lab.home_visit_area.index');
    }
    public function view($id)
    {
        $data = HomeVisitArea::where('id',$id)->first();
        return view('admin.manage_lab.home_visit_area.view',compact('data'));

    }
    public function delete($id = null)
    {
        $homevisitarea  = HomeVisitArea::find($id);
        $homevisitarea->delete();
        Flash::success( __('action.deleted', ['type' => 'Home Visit Area']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $homevisit  = HomeVisitArea::find($request->id);
        if($request->val == 1)
        {
            $homevisit->status = 0;
            $homevisit->save();
        }
        else{
            $homevisit->status = 1;
            $homevisit->save();
        }
        Flash::success( __('action.status', ['type' => 'Home Visit']));

    }
}
