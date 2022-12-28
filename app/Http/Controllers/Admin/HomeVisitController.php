<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\HomeVisit;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class HomeVisitController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.home_visit'))
        {
        if($request->ajax()) {
            $data = HomeVisit::with('package')->select('*')->orderBy('created_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()   
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $delete = '';
                    $view = button('view',route('home_visit.view', $data->id));
                    
                    if($user->hasAccess('user.delete.home_visit'))
                    $delete = button('delete',route('home_visit.delete', $data->id));
                    return $view.$delete;
                })
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('home_visit.status', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.enquiry.home_visit.index');
        }
        else
        {
            if($user->hasAccess('user.view.packages')){
                return redirect()->route('enquiry_package.index');
            }
            else if($user->hasAccess('user.view.contact_us'))
            {
                return redirect()->route('contact_us.index');
            }
            else{
                Flash::error( __('action.permission'));
                return redirect()->route('admin.dashboard');
            }
        }
    }
    public function view($id)
    {
        $data = HomeVisit::where('home_visits.id',$id)->select('home_visits.*','manage_packages.packageName as package')->join('manage_packages','manage_packages.id','=','home_visits.packageId')->first();
        return view('admin.enquiry.home_visit.view',compact('data'));

    }
    public function delete($id = null)
    {
        $homevisit  = HomeVisit::find($id);
        $homevisit->delete();
        Flash::success( __('action.deleted', ['type' => 'Home Visit']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $homevisit  = HomeVisit::find($request->id);
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
