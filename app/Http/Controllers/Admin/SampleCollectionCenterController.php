<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SampleCollectionCenters;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
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

                    $view = button('view',route('sample-collection-center.view', $data->id));

                    if($user->hasAccess('user.delete.sample_collection'))
                    $delete = button('delete',route('sample-collection-center.delete', $data->id));

                    return $view.$delete;
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
    public function view($id)
    {
        $data = SampleCollectionCenters::where('id',$id)->first();
        return view('admin.manage_lab.samplecollection.view',compact('data'));

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
}
