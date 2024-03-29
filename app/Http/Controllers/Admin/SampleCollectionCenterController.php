<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\SampleCollectionCenters;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class SampleCollectionCenterController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.sample_collection'))
        {
        if($request->ajax()) {
            $data = SampleCollectionCenters::select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()   
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $delete = '';
                    $view = '';
                    $edit = '';

                    $view = button('view',route('sample-collection-center.view', $data->id));
                    $edit = button('edit',route('sample-collection-center.edit', $data->id));

                    if($user->hasAccess('user.delete.sample_collection'))
                    $delete = button('delete',route('sample-collection-center.delete', $data->id));

                    return $view.$edit.$delete;
                })
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('sample-collection-center.status', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.manage_lab.samplecollection.index');
        }
        else
        {
            Flash::error( __('action.permission'));
            return redirect()->route('admin.dashboard');

        }
    }
    public function store(Request $request,$id = null)
    {
        // $this->validate($request, [
        //     'sorting_order' => 'nullable|unique:sample_collection_centers,sorting_order,'.$id.',id,deleted_at,NULL',
        // ]);
        if($id)
        {
            $data = SampleCollectionCenters::where('id',$id)->first();

           
         
            $data->sorting_order = $request->sorting_order;
            $data->status = $request->status;
            $data->update();
        }
        Flash::success( __('action.saved', ['type' => 'Sample collection center']));
        return redirect()->route('sample-collection-center.index');
    }
    public function view($id)
    {
        $data = SampleCollectionCenters::where('id',$id)->first();
        return view('admin.manage_lab.samplecollection.view',compact('data'));

    }
    public function edit($id = null)
    {
        $data = SampleCollectionCenters::where('id',$id)->first();
        $city =City::where('status',1)->get();
        return view('admin.manage_lab.samplecollection.edit',compact('data','city'));
    }
    public function delete($id = null)
    {
        $samplecollection  = SampleCollectionCenters::find($id);
        $samplecollection->delete();
        Flash::success( __('action.deleted', ['type' => 'Home Visit Area']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $samplecollection  = SampleCollectionCenters::find($request->id);
        if($request->val == 1)
        {
            $samplecollection->status = 0;
            $samplecollection->save();
        }
        else{
            $samplecollection->status = 1;
            $samplecollection->save();
        }
        Flash::success( __('action.status', ['type' => 'Home Visit']));

    }
    public function syncRequest()
    {
        $key = 'agdpixel';
        $secret = 'p1x3l@agd';
        $responseSampleCollectionCenters = Http::withBasicAuth($key, $secret)
          ->get('https://agdmatrix.dyndns.org/a/Pixel/SampleCollectionCenters');
        $responseSampleCollectionCenters = json_decode($responseSampleCollectionCenters);
        if (!is_null($responseSampleCollectionCenters)) {
          // SampleCollectionCenters::truncate();
          foreach ($responseSampleCollectionCenters as $key => $val) {
            $data = [
              'centerId' => $val->centerId,
              'localityId' => $val->localityId,
              'location' => $val->location,
              'timing' => $val->timing,
              'address' => $val->address,
              'cityId' => $val->cityId,
              'city' => $val->city,
              'stateId' => $val->stateId,
              'state' => $val->state,
              'phone' => $val->phone,
              'email' => $val->email,
              'latitude' => $val->latitude,
              'longitude' => $val->longitude,
              'googleReviewLink' => $val->googleReviewLink,
              'whatsAppLink' => $val->whatsAppLink,
              'sorting_order' =>'',
              'status' => 1,
            ];
            $res = SampleCollectionCenters::updateOrCreate(['centerId' => $val->centerId,'cityId' => $val->cityId],$data);
          }
        }
        Flash::success( __('masters.sync_success'));
        return redirect()->back();
    }
}
