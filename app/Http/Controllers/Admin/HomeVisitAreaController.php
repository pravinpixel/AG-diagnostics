<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeVisitArea;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class HomeVisitAreaController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.home_visit_area'))
        {
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
        else
        {
            if($user->hasAccess('user.view.sample_collection'))
            {
                return redirect()->route('sample-collection-center.index');
            }
            else{
                Flash::error( __('action.permission'));
                return redirect()->route('admin.dashboard');
            }
            
        }
       
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
    public function syncRequest()
    {
    $key = 'agdpixel';
    $secret = 'p1x3l@agd';
    $responseHomeVisitArea = Http::withBasicAuth($key, $secret)
      ->get('https://agdmatrix.dyndns.org/a/Pixel/HomeVisitAreas');
    $responseHomeVisitArea = json_decode($responseHomeVisitArea);
    if (!is_null($responseHomeVisitArea)) {
      // HomeVisitArea::truncate();
      foreach ($responseHomeVisitArea as $key => $val) {
        $data = [
          'areaId' => $val->areaId,
          'area' => $val->area,
          'cityId' => $val->cityId,
          'city' => $val->city,
          'stateId' => $val->stateId,
          'state' => $val->state,
          'status' => 1,
        ];
        $res = HomeVisitArea::updateOrCreate($data);
      }
    }
        Flash::success( __('masters.sync_success'));
        return redirect()->back();
    }
}
