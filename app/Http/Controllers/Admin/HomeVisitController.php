<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\HomeVisit;
use App\Models\Admin\HomeVisitArea;
use App\Models\Admin\ManagePackage;
use App\Models\Admin\ManageTest;
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
        $data = HomeVisit::where('home_visits.id',$id)
        ->first();
        $packageName            = [];
        $testName               = [];
        $packageAmount          = '';
        $testAmount             = '';
        $location               = '';
        
        $package_split_data = str_replace(["[","]"],"",$data['packageId']);
        $package_explode_data = explode(",",$package_split_data);
        foreach($package_explode_data as $key=>$val)
        {
            $package_exploade_id = (explode(":",$val));
            $package_data= ManagePackage::select('manage_packages.packageName')->find($package_exploade_id[0]);
            array_push($packageName,"<td>".$package_data['packageName']."</td><td style='text-align:right'>".$package_exploade_id[1]." ₹ </td>");
        };


        $test_split_data = str_replace(["[","]"],"",$data['title']);
        $test_explode_data = explode(",",$test_split_data);
        foreach($test_explode_data as $key=>$val)
        {
            $test_exploade_id = (explode(":",$val));
            $test_data= ManageTest::select('manage_tests.testName')->find($test_exploade_id[0]);
            array_push($testName,"<td>".$test_data['testName']."</td><td style='text-align:right'>".$test_exploade_id[1].' ₹ </td>');
        };


        // dd($testName);
        // die();
        // if($data['packageId'] != null)
        // {
        //     $packageId  = json_decode($data['packageId']);

        //     foreach($packageId as $key =>$val)
        //     {
        //         $package_data= ManagePackage::select('manage_packages.packageName')->find($val);
        //         array_push($packageName,$package_data['packageName']);
        //     }
        // }

        // if($data['title'] != null)
        // {
        //     $testId  = json_decode($data['title']);

        //     foreach($testId as $key =>$val)
        //     {
        //         $test_data= ManageTest::select('manage_tests.testName')->find($val);
        //         array_push($testName,$test_data['testName']);
        //     }
        // }
        // if(!empty($data['package_amount']))
        // {
        //     $packageAmount  = json_decode($data['package_amount']);
        // }
        // if(!empty($data['test_amount']))
        // {
        //     $testAmount  = json_decode($data['test_amount']);
        // }
        if($data->cityId)
        {
            $location = HomeVisitArea::select('area','city')->where('areaId',$data->areaId)->where('cityId',$data->cityId)->first();
        }
        $data ['packageName'] = $packageName;
        $data ['testName'] = $testName;
        $data ['packageAmount'] = $packageAmount;
        $data ['testAmount'] = $testAmount;
        $data ['city'] = $location['city'];
        $data ['area'] = $location['area'];
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
